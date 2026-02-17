<x-app-layout>

<div class="max-w-3xl mx-auto mt-10 bg-white shadow p-6 rounded">

    <h2 class="text-2xl font-bold mb-4 text-green-700">
        Votre commande a été récupérée !
    </h2>

    <p class="mb-4">Merci, votre commande a bien été récupérée.</p>

    <h3 class="text-xl font-semibold mb-2">Récapitulatif :</h3>

    <p><strong>Commande #{{ $commande->id }}</strong></p>
    <p><strong>Total :</strong> {{ $commande->total }} €</p>

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

