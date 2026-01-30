<x-app-layout>

<div class="max-w-4xl mx-auto mt-10 bg-white shadow-md rounded-lg p-6">

    <h2 class="text-2xl font-bold mb-6">Mes commandes</h2>

    {{-- Informations utilisateur --}}
    <div class="p-4 border rounded-lg bg-gray-50 mb-8">
        <h3 class="text-xl font-semibold mb-3">Informations personnelles</h3>

        <p class="mb-2"><strong>Nom :</strong> {{ $user->name }}</p>
        <p class="mb-2"><strong>Email :</strong> {{ $user->email }}</p>

        @if($user->telephone)
            <p class="mb-2"><strong>Téléphone :</strong> {{ $user->telephone }}</p>
        @endif

        <p class="mb-2"><strong>Date d'inscription :</strong> {{ $user->created_at->format('d/m/Y') }}</p>
    </div>

    {{-- Liste des commandes --}}
    @if($commandes->isEmpty())
        <p class="text-gray-600 text-center">Vous n'avez encore passé aucune commande.</p>
    @else
        <div class="space-y-6">

            @foreach($commandes as $commande)
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
                        <strong>Statut :</strong>
                        <span class="font-semibold">
                            {{ ucfirst($commande->statut) }}
                        </span>
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
            @endforeach

        </div>
    @endif

</div>
</x-app-layout>

