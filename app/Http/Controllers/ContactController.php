<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'contenu' => 'required',
        ]);

        Message::create([
            'user_id' => auth()->id(),
            'contenu' => $data['contenu'],
        ]);

        return back()->with('success', 'Message envoyé.');
    }
}

