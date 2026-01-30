@extends('layouts.admin')

@section('content')

<h1>Gestion des rendez-vous</h1>

<form action="{{ route('admin.rendezvous.store') }}" method="POST">
    @csrf

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Jour</th>
            @foreach($heures as $heure)
                <th>{{ $heure }}</th>
            @endforeach
        </tr>

        @foreach($jours as $jour)
        <tr>
            <td><strong>{{ $jour }}</strong></td>

            @foreach($heures as $heure)
                @php
                    $slot = $slots[$jour][$heure] ?? null;
                @endphp

                <td style="text-align:center;
                    background-color:
                        {{ $slot && $slot->est_disponible ? '#c8f7c5' : '#f7c5c5' }};
                ">

                    @if($slot)
                        {{-- Case existante --}}
                        <input type="checkbox"
                               name="creneaux[]"
                               value="{{ $slot->id }}"
                               {{ $slot->est_disponible ? 'checked' : '' }}>
                    @else
                        {{-- Case inexistante : possibilité de créer --}}
                        <button type="submit"
                                name="action"
                                value="create"
                                style="background:none;border:none;color:blue;cursor:pointer;">
                            Ajouter
                        </button>

                        <input type="hidden" name="jour" value="{{ $jour }}">
                        <input type="hidden" name="heure" value="{{ $heure }}">
                    @endif

                </td>
            @endforeach
        </tr>
        @endforeach
    </table>

    <br>
    <button type="submit">Mettre à jour les disponibilités</button>
</form>

@endsection





