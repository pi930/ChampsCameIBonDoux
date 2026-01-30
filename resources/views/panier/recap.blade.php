<x-app-layout>

<div class="max-w-3xl mx-auto py-10">

    <h1 class="text-2xl font-bold mb-6">Récapitulatif de votre panier</h1>

    <div class="bg-white shadow p-6 rounded-lg">

        @if($produits->isEmpty())
            <p class="text-gray-600">Aucun produit sélectionné.</p>
        @else

            <h2 class="text-xl font-semibold mb-4">Produits choisis</h2>

            <ul class="space-y-3 mb-6">
                @foreach($produits as $produit)
                    <li class="p-3 border rounded bg-gray-50">
                        {{ $produit->nom }}
                    </li>
                @endforeach
            </ul>

            <div class="border-t pt-4">
                <p class="text-lg">
                    <strong>Prix du panier :</strong>
                    <span class="text-green-600 font-bold">30 €</span>
                </p>
            </div>

        @endif

        <div class="mt-6 flex justify-between">
            <a href="{{ route('panier.construire') }}"
               class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">
                Modifier mon panier
            </a>
            @if($rendezvous)
    <h2>Votre rendez-vous</h2>

    <p>
        Date : {{ $rendezvous->date }}<br>
        Heure : {{ $rendezvous->heure }}<br>
        Adresse : {{ $rendezvous->adresse ?? 'À définir' }}
    </p>
@endif

<h2 class="text-2xl font-bold mt-10 mb-4">Choisissez votre formule</h2>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <!-- Formule 1 mois -->
    <form action="{{ route('paiement') }}" method="GET"
          class="border rounded-xl p-6 shadow hover:shadow-lg transition bg-white">
        
        <h3 class="text-xl font-semibold mb-2">Formule 1 mois</h3>
        <p class="text-gray-600 mb-4">Accès complet pendant 30 jours</p>

        <div class="text-3xl font-bold mb-6">30 €</div>

        <input type="hidden" name="formule" value="1_mois">

        <button class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition">
            Choisir cette formule
        </button>
    </form>

    <!-- Formule 4 paniers (1 mois) -->
<form action="{{ route('paiement') }}" method="GET"
      class="border rounded-xl p-6 shadow hover:shadow-lg transition bg-white">
    
    <h3 class="text-xl font-semibold mb-2">Formule 4 paniers</h3>
    <p class="text-gray-600 mb-4">4 paniers sur 1 mois</p>

    <div class="text-3xl font-bold mb-6">105 €</div>

    <input type="hidden" name="formule" value="4_paniers">

    <button class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
        Choisir cette formule
    </button>
</form>


</div>


            <a href="{{ route('paiement') }}" class="btn btn-primary">
    Procéder au paiement
</a>

        </div>

    </div>

</div>

</x-app-layout>

