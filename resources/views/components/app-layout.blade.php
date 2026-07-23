<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans antialiased">

    <!-- Bande jaune forcé -->
    <div style="background-color: #fde047;"
         class="w-full text-gray-900 py-2 text-center font-semibold shadow">
        ChampsCameIBonDoux — Produits bio de saison 🌱
    </div>

    @include('layouts.navigation')

    <main class="min-h-screen">
        {{ $slot }}
    </main>

</body>
</html>


