@extends('layouts.admin')

@section('content')

<h1>Messages des utilisateurs</h1>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>Utilisateur</th>
        <th>Email</th>
        <th>Message</th>
        <th>Date</th>
        <th>Action</th>
    </tr>

    @foreach($messages as $m)
    <tr>
        <td>{{ $m->user->prenom ?? 'Visiteur' }}</td>
        <td>{{ $m->email }}</td>
        <td>{{ Str::limit($m->message, 50) }}</td>
        <td>{{ $m->created_at->format('d/m/Y') }}</td>
        <td><a href="{{ route('admin.messages.show', $m->id) }}">Voir</a></td>
    </tr>
    @endforeach

</table>
@endsection

