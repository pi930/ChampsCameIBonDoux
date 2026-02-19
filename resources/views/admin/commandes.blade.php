@extends('layouts.admin')

@section('content')

<h1>Commandes payées</h1>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>Utilisateur</th>
        <th>Produits</th>
        <th>Montant</th>
        <th>Rendez-vous</th>
        <th>Formule</th>
        <th>Date</th>
        <th>Statut</th>
        <th>Actions</th>
    </tr>

    @foreach($commandes as $c)
    <tr>
        <td>{{ $c->user->name }}</td>

        <td>
            @foreach($c->panier->produits as $p)
                {{ $p->nom }}<br>
            @endforeach
        </td>

        <td>{{ $c->total }} €</td>

        <td>
            {{ $c->rendezVous->date ?? '' }}
            {{ $c->rendezVous->heure ?? '' }}
        </td>

        <td>
            @if($c->formule === '4_paniers')
                <span style="color:green;">4 paniers (1 mois)</span>
            @else
                1 panier
            @endif
        </td>

        <td>{{ $c->created_at->format('d/m/Y') }}</td>

       <td>
    @if($c->statut_retrait === 'recupere')
    <span style="color:green;">Récupérée</span>
@elseif($c->statut_retrait === 'pret')
    <span style="color:blue;">Prête</span>
@else
    <span style="color:orange;">En attente</span>
@endif
</td>



        <td>
            <form action="{{ route('admin.commandes.statut', $c->id) }}" method="POST">
    @csrf
    @method('PUT')

    @if($c->statut_retrait !== 'recupere')
        <button name="statut" value="recupere" style="color:green;">Récupéré</button>
    @endif

    @if($c->statut_retrait !== 'pret')
        <button name="statut" value="pret" style="color:blue;">Prête</button>
    @endif

    @if($c->statut_retrait !== 'attente')
        <button name="statut" value="attente" style="color:orange;">En attente</button>
    @endif
</form>
        </td>
    </tr>
    @endforeach
</table>


<h1 style="margin-top:40px;">Paniers programmés</h1>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>Utilisateur</th>
        <th>Date disponible</th>
        <th>Type</th>
    </tr>

    @foreach($paniers_programmes as $p)
    <tr>
        <td>{{ $p->user->prenom }} {{ $p->user->nom }}</td>
        <td>{{ \Carbon\Carbon::parse($p->date_disponible)->format('d/m/Y') }}</td>
        <td>{{ $p->type }}</td>
    </tr>
    @endforeach
</table>

@endsection

