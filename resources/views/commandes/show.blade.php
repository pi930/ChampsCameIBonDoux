<x-app-layout>

<div class="max-w-3xl mx-auto mt-10 bg-white shadow p-6 rounded">

    <h2 class="text-2xl font-bold mb-4 text-green-700">
        Détails de la commande
    </h2>

    <p><strong>Commande #{{ $commande->id }}</strong></p>
    <p><strong>Total :</strong> {{ $commande->total }} €</p>

    <p><strong>Statut retrait :</strong>
        @if($commande->statut_retrait === 'recupere')
            Récupérée
        @elseif($commande->statut_retrait === 'pret')
            Prête
        @else
            En attente
        @endif
    </p>

    <h4 class="mt-4 font-semibold">Produits :</h4>
    <ul class="list-disc pl-6">
        @foreach($commande->panier->produits as $p)
            <li>{{ $p->nom }} × {{ $p->pivot->quantite }}</li>
        @endforeach
    </ul>

    <div class="mt-6">
        <a href="{{ route('dashboard') }}"
           class="px-4 py-2 bg-green-600 text-white rounded">
            Retour à mon espace
        </a>
    </div>

</div>

</x-app-layout>

