<x-app-layout>

<div class="max-w-3xl mx-auto py-10">

    <h1 class="text-3xl font-bold mb-6">Paiement</h1>

    <div class="bg-white shadow p-6 rounded-lg space-y-6">

        <h2 class="text-xl font-semibold">Formule choisie</h2>

        <p class="text-lg">
            @if($formule === 'simple')
    <strong>Panier simple</strong> — 30 €
@elseif($formule === '4_paniers')
    <strong>Formule 4 paniers (1 mois)</strong> — 105 €
@endif
        </p>

        <form action="{{ route('paiement.process') }}" method="POST">
            @csrf

            <input type="hidden" name="formule" value="{{ $formule }}">

            <button class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                Procéder au paiement
            </button>
        </form>

    </div>

</div>

</x-app-layout>

