<?php

namespace App\Http\Controllers;

use App\Models\Symposium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SymposiumController extends Controller
{   
    private function checkSymposiumProgress() {
        //          Verifica se existe alguma edição em andamento
        $symposium = Symposium::latest()->first();
        if ($symposium != null && $symposium->end_date == null) {
            return $symposium;
        }
        return false;
    }

    private function checkSymposiumExists($edition) {
        //          Verifica se uma edição especifica existe
        $symposium = Symposium::where('edition', $edition)->latest()->first();
        if ($symposium != null) {
            return $symposium;
        }
        return false;
    }

    public function startSymposium(Request $request)
    {   
        if (!$this->checkSymposiumProgress()) { // Verificação de Edição em Andamento
            if ($request->method() == 'GET') { // Resposta para quando apertar o botão de iniciar no Menu de Administrador
                return view('initSymposium');

            } elseif ($request->method() == 'POST') { // Resposta para quando apertar o botão de 'Iniciar Simpósio'
                $user = Auth::user();
    
                if (!Hash::check($request->password, $user->password)) { // Verifica se a senha está incorreta
                    return redirect()->back()->with(['status' => 'danger', 'message' => 'A senha inserida está incorreta. Verifique o valor inserido!' ]);
                }

                if (!$request->has('confirm_checkbox')) { // Verifica se os termos foram aceitos
                    return redirect()->back()->with(['status' => 'danger', 'message' => 'Aceite os Termos marcando a caixa de seleção para poder Iniciar o Simpósio!' ]);
                }

                if ($request->edition != null && !$this->checkSymposiumExists($request->edition)) { // Verifica se existe a edição inserida
                    $symposium = new Symposium();
                    $symposium->edition = $request->edition;
                    $symposium->start_date = now();

                    if ($symposium->save()) { // Verifica se os dados foram armazenados com sucesso no banco de dados
                        return redirect()->route('admin.home')->with(['status' => 'success', 'message' => 'Edição criada com sucesso!' ]);
                    }

                    return redirect()->back()->with(['status' => 'danger', 'message' => 'Ocorreu um erro na criação da Edição!' ]);
                }
                
                return redirect()->back()->with(['status' => 'danger', 'message' => 'Edição indisponível. Verifique o valor inserido!' ]);
            }
        }

        return redirect()->route('admin.home')->with(['status' => 'danger', 'message' => 'Simpósio em Andamento. Finalize a edição atual para iniciar uma nova!' ]);
    }

    public function endSymposium(Request $request)
{   
    $symposium = $this->checkSymposiumProgress();
    if ($symposium) { // Verificação de Edição em Andamento
        if ($request->method() == 'GET') { // Resposta para quando apertar o botão de finalizar no Menu de Administrador
            return view('endSymposium');
        } elseif ($request->method() == 'POST') { // Resposta para quando apertar o botão de 'Finalizar Simpósio'
            $user = Auth::user();

            if (!Hash::check($request->password, $user->password)) { // Verifica se a senha está incorreta
                return redirect()->back()->with(['status' => 'danger', 'message' => 'A senha inserida está incorreta. Verifique o valor inserido!' ]);
            }

            if (!$request->has('confirm_checkbox')) { // Verifica se os termos foram aceitos
                return redirect()->back()->with(['status' => 'danger', 'message' => 'Aceite os Termos marcando a caixa de seleção para poder Finalizar o Simpósio!' ]);
            }

            $symposium->end_date = now();

            if ($symposium->save()) { // Verifica se os dados foram armazenados com sucesso no banco de dados
                return redirect()->route('admin.home')->with(['status' => 'success', 'message' => 'Edição finalizada com sucesso!' ]);
            } else {
                return redirect()->back()->with(['status' => 'danger', 'message' => 'Ocorreu um erro na finalização da Edição!' ]);
            }
        }
    } else {
        return redirect()->route('admin.home')->with(['status' => 'danger', 'message' => 'Nenhuma Edição em Andamento' ]);
    }
}

}