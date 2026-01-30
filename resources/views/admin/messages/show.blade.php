@extends('layouts.admin')

@section('content')

<h1>Message de {{ $message->email }}</h1>

<p><strong>Envoyé le :</strong> {{ $message->created_at->format('d/m/Y H:i') }}</p>

<p><strong>Contenu :</strong></p>
<p>{{ $message->message }}</p>

<h3>Répondre</h3>

<form action="{{ route('admin.messages.reply', $message->id) }}" method="POST">
    @csrf
    <textarea name="reponse" rows="5" style="width:100%;"></textarea>
    <br><br>
    <button type="submit">Envoyer la réponse</button>
</form>

@endsection

