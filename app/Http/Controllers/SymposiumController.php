<?php

namespace App\Http\Controllers;

use App\Models\Symposium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SymposiumController extends Controller
{
    public function startSymposium(Request $request)
    {   
        /*
        $symposium = Symposium::where('edition', $request->input('edition'))->latest()->first();
        if ($symposium != NULL) {
            $symposium = new Symposium();
            $symposium->edition = $request->input('edition');
            $symposium->start_date = now();
            $symposium->save();

            return redirect()->back()->with(['status' => 'success', 'message' => 'Simpósio iniciado com sucesso!']);
        } else {
            return redirect()->back()->with(['status' => 'warning', 'message' => 'Simpósio existente.' ]);
        }*/


        if ($request->method() == 'GET') {
            return view('initSymposium');
        } elseif ($request->method() == 'POST') {
            $user = Auth::user();

            if (!Hash::check($request->password, $user->password)) {
                return redirect()->back()->with(['status' => 'danger', 'message' => 'A senha inserida está incorreta!' ]);
            }
        }
    }
//isso não funciona
    public function endSymposium(Request $request)
{
    $user = Auth::user();

    //return $request->edition;

    if (!Hash::check($request->password, $user->password)) {
        return redirect()->route('admin.home')->withErrors(['password' => 'Senha incorreta.']);
    }

    $symposium = Symposium::where('edition', $request->edition)->latest()->first();
    if ($symposium) {
        $symposium->end_date = now();
        $symposium->save();
    } else {
        //return redirect()->route('admin.home')->with(['status' => 'warning', 'message' => 'Simpósio inexistente.' ]);
        return response()->json([
            'status' => 'warning',
            'message' => 'Simpósio inexistente.',
            'redirect_url' => route('admin.home'),
        ]);
    }

    return redirect()->route('admin.home')->with('status', 'Simpósio finalizado com sucesso!');
}

}