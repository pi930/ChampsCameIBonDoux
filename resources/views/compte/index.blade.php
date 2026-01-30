<x-app-layout>
<div class="max-w-3xl mx-auto mt-10 bg-white shadow-md rounded-lg p-6">

    <h2 class="text-2xl font-bold mb-6">Mon compte</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div class="p-4 border rounded-lg bg-gray-50">
            <h3 class="text-xl font-semibold mb-3">Informations personnelles</h3>

            <p class="mb-2"><strong>Nom :</strong> {{ $user->name }}</p>
            <p class="mb-2"><strong>Email :</strong> {{ $user->email }}</p>

            @if($user->telephone)
                <p class="mb-2"><strong>Téléphone :</strong> {{ $user->telephone }}</p>
            @endif

            <p class="mb-2"><strong>Date d'inscription :</strong> {{ $user->created_at->format('d/m/Y') }}</p>
        </div>

        <div class="p-4 border rounded-lg bg-gray-50">
            <h3 class="text-xl font-semibold mb-3">Actions</h3>

            <ul class="space-y-3">
                <li>
                    <a href="/mes-commandes" class="text-green-600 font-semibold hover:underline">
                        Voir mes commandes
                    </a>
                </li>

                <li>
                    <a href="/rendez-vous" class="text-green-600 font-semibold hover:underline">
                        Mes rendez-vous
                    </a>
                </li>

                <li>
                    <a href="/panier" class="text-green-600 font-semibold hover:underline">
                        Mon panier
                    </a>
                </li>

                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="text-red-600 font-semibold hover:underline">
                            Déconnexion
                        </button>
                    </form>
                </li>
            </ul>
        </div>

    </div>

</div>
</x-app-layout>

