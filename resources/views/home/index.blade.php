<x-app-layout>

<div class="max-w-5xl mx-auto py-12 bg-yellow-100 rounded-xl shadow">

    <div class="text-center">
        <h1 class="text-4xl font-bold text-gray-800">
            Produits bio de saison à Nice
        </h1>

        <p class="mt-4 text-lg text-gray-600">
            Sonia Chancame Ibonndhou vous propose des paniers frais et locaux.
        </p>

        <a href="{{ route('panier.construire') }}"
           class="inline-block mt-8 px-6 py-3 bg-green-600 text-white rounded-lg
                  hover:bg-green-700 transition">
            Commander un panier 🧺
        </a>
    </div>

    <div class="mt-12">
    <img src="{{ asset('images/marechage.jpg') }}"
         class="rounded-xl shadow w-full h-80 object-cover"
         alt="Maraîchage">
</div>


</div>

</x-app-layout>
