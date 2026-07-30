<x-app-layout>

<div class="max-w-3xl mx-auto py-10 rounded-xl shadow"
     style="background-color: #fff3b0;">

    <h1 class="text-2xl font-bold mb-6">Constituez votre panier</h1>

    <form action="{{ route('panier.store') }}" method="POST"
          class="bg-white shadow p-6 rounded-lg space-y-4">
        @csrf

        @foreach($produits as $produit)
    <label class="flex items-center space-x-4 p-3 border rounded hover:bg-gray-50 cursor-pointer">

        <img
            src="{{ Storage::url($produit->image) }}"
            alt="{{ $produit->nom }}"
            class="h-14 w-14 object-cover rounded"
        >

        <input type="checkbox"
               name="produits[]"
               value="{{ $produit->id }}"
               class="h-5 w-5 text-blue-600">

        <div class="flex flex-col">
            <span class="text-lg font-semibold">{{ $produit->nom }}</span>
        </div>

    </label>
@endforeach


        <button type="submit"
                class="w-full mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            Valider mon panier
        </button>
    </form>

    <div class="mt-10">
        <a href="{{ route('rendezvous.index') }}"
           class="w-full block text-center px-4 py-3 bg-green-600 text-white rounded hover:bg-green-700 transition">
            Prendre un rendez-vous
        </a>
    </div>

</div>

</x-app-layout>



