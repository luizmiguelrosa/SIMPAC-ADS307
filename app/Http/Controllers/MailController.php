<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\DemoMail;
use Illuminate\Support\Facades\Mail as FacadesMail;

class MailController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $mailData = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp.'
        ];
           
        FacadesMail::to('viniciusfontesads@gmail.com')->send(new DemoMail($mailData));
        dd("Email is sent successfully.");
    }
}