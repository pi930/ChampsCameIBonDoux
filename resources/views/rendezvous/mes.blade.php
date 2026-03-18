<x-app-layout>

    <div class="max-w-5xl mx-auto py-12 px-6">

        <!-- Titre -->
        <h1 class="text-4xl font-extrabold text-green-700 mb-10 flex items-center gap-3">
            <span class="text-5xl">📅</span> Mes rendez-vous
        </h1>

        @if($rendezvous->isEmpty())

            <!-- Message si aucun rendez-vous -->
            <div class="bg-yellow-50 border border-yellow-300 text-yellow-800 p-6 rounded-xl shadow-sm">
                <h2 class="text-xl font-semibold mb-2">Aucun rendez-vous pour le moment</h2>
                <p class="text-sm">Vous pouvez en réserver un depuis la page des disponibilités.</p>
            </div>

        @else

            <!-- Grille responsive -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach($rendezvous as $rdv)
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 hover:shadow-2xl transition duration-300">

                        <!-- Badge -->
                        <div class="flex justify-end mb-4">
                            <span class="bg-green-100 text-green-700 px-4 py-1 rounded-full text-sm font-semibold">
                                Réservé
                            </span>
                        </div>

                        <!-- Contenu -->
                        <div class="space-y-3">

                            <p class="text-xl font-bold text-gray-800 flex items-center gap-2">
                                📆 {{ \Carbon\Carbon::parse($rdv->date)->translatedFormat('l d F Y') }}
                            </p>

                            <p class="text-gray-600 text-lg flex items-center gap-2">
                                ⏰ {{ \Carbon\Carbon::parse($rdv->heure)->format('H:i') }}
                            </p>

                            <p class="text-gray-700 text-sm mt-4">
                                <span class="font-semibold text-green-700">Statut :</span>
                                {{ $rdv->statut ?? 'Confirmé' }}
                            </p>

                        </div>

                    </div>
                @endforeach

            </div>

        @endif

    </div>

</x-app-layout>



