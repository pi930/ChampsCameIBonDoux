<x-app-layout>
<div class="max-w-lg mx-auto mt-10 bg-white shadow-md rounded-lg p-6">

    <h2 class="text-2xl font-bold mb-6 text-center">Contactez-nous</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @auth
        <form method="POST" action="{{ route('contact.send') }}">
            @csrf

            <div class="mb-4">
                <label class="block font-semibold mb-1">Votre message</label>
                <textarea name="contenu" rows="5" class="w-full border rounded p-2" required></textarea>
            </div>

            <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
                Envoyer
            </button>
        </form>
    @else
        <p class="text-center text-gray-700">
            Vous devez être connecté pour envoyer un message.
        </p>
        <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="text-green-600 font-semibold">Connexion</a>
        </div>
    @endauth

</div>
</x-app-layout>

