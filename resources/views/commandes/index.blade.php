<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mes commandes
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if ($commandes->isEmpty())
                <p class="text-gray-600">Vous n'avez encore aucune commande.</p>
            @else
                <table class="min-w-full bg-white border rounded-lg overflow-hidden shadow">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border">#</th>
                            <th class="px-4 py-2 border">Statut retrait</th>
                            <th class="px-4 py-2 border">Total</th>
                            <th class="px-4 py-2 border">Créée le</th>
                            <th class="px-4 py-2 border">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($commandes as $commande)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border text-center">
                                    {{ $commande->id }}
                                </td>

                                <td class="px-4 py-2 border text-center">
                                    @if ($commande->statut_retrait === 'en_attente')
                                        <span class="px-2 py-1 text-sm bg-yellow-200 text-yellow-800 rounded">
                                            En attente
                                        </span>
                                    @elseif ($commande->statut_retrait === 'pret')
                                        <span class="px-2 py-1 text-sm bg-blue-200 text-blue-800 rounded">
                                            Prête
                                        </span>
                                    @elseif ($commande->statut_retrait === 'recuperee')
                                        <span class="px-2 py-1 text-sm bg-green-200 text-green-800 rounded">
                                            Récupérée
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-sm bg-gray-200 text-gray-800 rounded">
                                            Inconnu
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 py-2 border text-center">
                                    {{ number_format($commande->total, 2, ',', ' ') }} €
                                </td>

                                <td class="px-4 py-2 border text-center">
                                    {{ $commande->created_at->format('d/m/Y H:i') }}
                                </td>

                                <td class="px-4 py-2 border text-center">
                                    <a href="{{ route('commande.recuperee', $commande->id) }}"
                                       class="text-blue-600 hover:text-blue-800 underline">
                                        Voir la commande
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

        </div>
    </div>
</x-app-layout>
