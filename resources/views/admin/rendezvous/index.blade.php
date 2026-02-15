@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-bold mb-6">Gestion des rendez-vous</h1>

<form action="{{ route('admin.rendezvous.store') }}" method="POST">
    @csrf

    <table border="1" cellpadding="10" cellspacing="0" class="w-full text-center">
        <tr>
            <th>Date</th>
            @foreach($heures as $heure)
                <th>{{ $heure }}</th>
            @endforeach
        </tr>

        @foreach($dates as $date)
        <tr>
            <td><strong>{{ \Carbon\Carbon::parse($date)->translatedFormat('l d F') }}</strong></td>

            @foreach($heures as $heure)
                @php
                    $slot = $slots[$date][$heure] ?? null;
                @endphp

                <td style="background-color: {{ $slot && $slot->est_disponible ? '#c8f7c5' : '#f7c5c5' }}">

                    @if($slot)
                        <input type="checkbox"
                               name="creneaux[]"
                               value="{{ $slot->id }}"
                               {{ $slot->est_disponible ? 'checked' : '' }}>
                    @else
                        <button type="submit"
                                name="action"
                                value="create"
                                style="background:none;border:none;color:blue;cursor:pointer;">
                            Ajouter
                        </button>

                        <input type="hidden" name="date" value="{{ $date }}">
                        <input type="hidden" name="heure" value="{{ $heure }}">
                    @endif

                </td>
            @endforeach
        </tr>
        @endforeach
    </table>

    <br>
    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
        Mettre à jour les disponibilités
    </button>
</form>

@endsection
