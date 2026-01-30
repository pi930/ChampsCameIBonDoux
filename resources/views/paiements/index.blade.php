<x-app-layout>

<div class="max-w-3xl mx-auto py-10">

    <h1 class="text-2xl font-bold mb-6">Paiement de votre commande</h1>

    <div class="bg-white shadow p-6 rounded-lg space-y-6">

        <h2 class="text-xl font-semibold">Récapitulatif du panier</h2>

        <ul class="space-y-2">
            @foreach($produits as $produit)
                <li class="p-3 border rounded bg-gray-50">
                    {{ $produit->nom }}
                </li>
            @endforeach
        </ul>

        <div class="border-t pt-4">
            <h2 class="text-xl font-semibold mb-2">Votre rendez-vous</h2>

            <p class="text-lg"><strong>Date :</strong> {{ $rendezvous->date }}</p>
            <p class="text-lg"><strong>Heure :</strong> {{ $rendezvous->heure }}</p>
            <p class="text-lg"><strong>Adresse :</strong> Impasse du Mercantour, Nice Lingostière</p>
        </div>

        <div class="border-t pt-4">
            <h2 class="text-xl font-semibold mb-4">Choisissez votre formule</h2>

            <form action="{{ route('paiement.stripe') }}" method="POST" class="space-y-4">
                @csrf

                <label class="flex items-center space-x-3 p-3 border rounded hover:bg-gray-50">
                    <input type="radio" name="formule" value="simple" class="h-5 w-5 text-blue-600" checked>
                    <span class="text-lg">Panier simple — <strong>30 €</strong></span>
                </label>

                <label class="flex items-center space-x-3 p-3 border rounded hover:bg-gray-50">
    <input type="radio" name="formule" value="4_paniers" class="h-5 w-5 text-blue-600">
    <span class="text-lg">Formule 4 paniers (1 mois) — <strong>105 €</strong></span>
</label>

                <button type="submit"
                        class="w-full mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Procéder au paiement
                </button>
            </form>
        </div>

    </div>

</div>

</x-app-layout>

