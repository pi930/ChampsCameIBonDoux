<x-app-layout>

<div class="max-w-3xl mx-auto py-10 text-center">

    <h1 class="text-3xl font-bold mb-4">Merci pour votre commande !</h1>

    <p class="text-lg mb-6">
        Votre paiement a été accepté.  
        Vous recevrez votre panier à l’adresse :
        <br>
        <strong>Impasse du Mercantour, Nice Lingostière</strong>
    </p>

    <a href="{{ route('dashboard') }}"
       class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
        Retour à mon espace
    </a>

</div>

</x-app-layout>

