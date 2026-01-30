@extends('layouts.admin')

@section('content')

<h1>Gestion des rendez-vous</h1>

<form action="{{ route('admin.rendezvous.store') }}" method="POST">
    @csrf

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Jour</th>
            <th>Heure</th>
            <th>Disponible</th>
        </tr>

        @foreach($creneaux as $c)
        <tr>
            <td>{{ $c->jour }}</td>
            <td>{{ $c->heure }}</td>
            <td>
                <input type="checkbox" name="creneaux[]" value="{{ $c->id }}" {{ $c->actif ? 'checked' : '' }}>
            </td>
        </tr>
        @endforeach
    </table>

    <br>
    <button type="submit">Mettre à jour les disponibilités</button>
</form>

@endsection

