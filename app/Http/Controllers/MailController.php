<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; // use Illuminate\Contracts\Mail\Mailer => Mauvais
use App\Mail\TestMail;

class MailController extends Controller 
{
    public function showForm()
    {
        return view('emails.form'); 
    }

    public function sendMail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required|string',
            'attachment' => 'nullable|file|max:2048', 
        ]);

        $messageContent = $request->message;
        $attachment = $request->file('attachment');

        Mail::to($request->email)->send(new TestMail($messageContent, $attachment));

        return back()->with('success', 'Email envoyé avec succès.');
    }
}
