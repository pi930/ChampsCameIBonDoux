<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin – {{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans antialiased">

<header class="bg-gray-900 text-white shadow">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        <div class="text-xl font-bold">Administration</div>

        <nav class="flex items-center space-x-6">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-300">Dashboard</a>
            <a href="{{ route('home') }}" class="hover:text-gray-300">Retour au site</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="hover:text-red-400">Déconnexion</button>
            </form>
        </nav>

    </div>
</header>

<main class="max-w-7xl mx-auto py-10 px-6">
    {{ $slot }}
</main>

</body>
</html>

