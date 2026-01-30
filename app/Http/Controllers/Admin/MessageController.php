<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with('user')->orderBy('created_at', 'desc')->get();

        return view('admin.messages.index', compact('messages'));
    }

    public function show($id)
    {
        $message = Message::findOrFail($id);

        return view('admin.messages.show', compact('message'));
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'reponse' => 'required|string'
        ]);

        $message = Message::findOrFail($id);

        // Ici tu peux envoyer un email ou stocker la réponse
        $message->repondu = true;
        $message->save();

        return redirect()->route('admin.messages.index')
                         ->with('success', 'Réponse envoyée.');
    }
}

