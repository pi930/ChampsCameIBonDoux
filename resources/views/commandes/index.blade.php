<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mes commandes
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if ($commandes->isEmpty())
                <p>Vous n'avez encore aucune commande.</p>
            @else
                <table class="min-w-full bg-white border">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border">#</th>
                            <th class="px-4 py-2 border">Statut</th>
                            <th class="px-4 py-2 border">Total</th>
                            <th class="px-4 py-2 border">Créée le</th>
                            <th class="px-4 py-2 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($commandes as $commande)
                            <tr>
                                <td class="px-4 py-2 border">{{ $commande->id }}</td>
                                <td class="px-4 py-2 border">{{ $commande->statut }}</td>
                                <td class="px-4 py-2 border">{{ $commande->total }} €</td>
                                <td class="px-4 py-2 border">{{ $commande->created_at }}</td>
                                <td class="px-4 py-2 border">
                                    <a href="{{ route('commande.recuperee', $commande->id) }}"
                                       class="text-blue-600 underline">
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

