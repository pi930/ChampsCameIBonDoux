<x-app-layout>

<div class="max-w-4xl mx-auto mt-10 bg-white shadow-md rounded-lg p-6">

    <h2 class="text-2xl font-bold mb-6 text-center">
        Merci pour votre commande !
    </h2>
    @if(!$commande)
    <p class="text-center text-gray-600">Vous n’avez encore passé aucune commande.</p>
    </x-app-layout>
    @php return; @endphp
@endif

    {{-- Informations personnelles --}}
    <div class="p-4 border rounded-lg bg-gray-50 mb-8">
        <h3 class="text-xl font-semibold mb-3">Vos informations</h3>

        <p class="mb-2"><strong>Nom :</strong> {{ $commande->user->name }}</p>
        <p class="mb-2"><strong>Email :</strong> {{ $commande->user->email }}</p>

        @if($commande->user->telephone)
            <p class="mb-2"><strong>Téléphone :</strong> {{ $commande->user->telephone }}</p>
        @endif
    </div>

    {{-- Récapitulatif commande --}}
    <div class="border rounded-lg p-4 bg-gray-50">

        <div class="flex justify-between items-center mb-3">
            <h3 class="text-xl font-semibold">
                Commande #{{ $commande->id }}
            </h3>

            <span class="text-sm text-gray-600">
                {{ $commande->created_at->format('d/m/Y') }}
            </span>
        </div>

        <p class="mb-2">
            <strong>Total :</strong>
            {{ number_format($commande->total, 2, ',', ' ') }} €
        </p>

        <p class="mb-2">
            <strong>Formule :</strong>
            @if($commande->formule === '4_paniers')
                4 paniers (1 mois) — 105 €
            @else
                Panier simple — 30 €
            @endif
        </p>

        @if($commande->rendezVous)
            <p class="mb-2">
                <strong>Rendez-vous :</strong>
                {{ \Carbon\Carbon::parse($commande->rendezVous->date)->format('d/m/Y') }}
                à
                {{ substr($commande->rendezVous->heure, 0, 5) }}
            </p>
        @endif

        @if($commande->formule === '4_paniers')
            <p class="mb-2 text-blue-700 font-semibold">
                Votre prochain panier sera disponible le
                {{ \Carbon\Carbon::parse($commande->rendezVous->date)->addWeek()->format('d/m/Y') }}
            </p>
        @endif

        @if($commande->panier && $commande->panier->produits->isNotEmpty())
            <div class="mt-4">
                <h4 class="font-semibold mb-2">Produits :</h4>

                <ul class="list-disc pl-6 space-y-1">
                    @foreach($commande->panier->produits as $produit)
                        <li>
                            {{ $produit->nom }}
                            — {{ number_format($produit->pivot->prix, 2, ',', ' ') }} €
                            × {{ $produit->pivot->quantite }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>

    <div class="text-center mt-8">
        <a href="{{ route('dashboard') }}"
           class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
            Retour à mon espace
        </a>
    </div>

</div>

</x-app-layout>
