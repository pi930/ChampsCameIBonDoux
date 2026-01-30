<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

    {{-- Navigation Admin --}}
    <x-admin-navigation />

    {{-- Contenu principal --}}
    <main class="max-w-7xl mx-auto py-8 px-4">
        @yield('content')
    </main>

</body>
</html>

