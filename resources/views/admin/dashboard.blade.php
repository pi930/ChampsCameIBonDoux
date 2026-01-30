@extends('layouts.admin')

@section('content')

    <h1 class="text-3xl font-bold mb-8">Tableau de bord</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Messages -->
        <a href="{{ route('admin.messages.index') }}"
           class="bg-white shadow hover:shadow-lg transition rounded-lg p-6 flex items-center gap-4 border border-gray-200">
            <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
                📩
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Messages</h3>
                <p class="text-gray-500 text-sm">Voir les messages reçus</p>
            </div>
        </a>

        <!-- Produits à cultiver -->
        <a href="{{ route('admin.produits.cultiver') }}"
           class="bg-white shadow hover:shadow-lg transition rounded-lg p-6 flex items-center gap-4 border border-gray-200">
            <div class="bg-green-100 text-green-600 p-3 rounded-full">
                🌱
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Produits à cultiver</h3>
                <p class="text-gray-500 text-sm">Gérer les cultures</p>
            </div>
        </a>

        <!-- Semis -->
        <a href="{{ route('admin.semis.index') }}"
           class="bg-white shadow hover:shadow-lg transition rounded-lg p-6 flex items-center gap-4 border border-gray-200">
            <div class="bg-yellow-100 text-yellow-600 p-3 rounded-full">
                🌾
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Semis</h3>
                <p class="text-gray-500 text-sm">Sélectionner les semis actifs</p>
            </div>
        </a>

        <!-- Produits à vendre -->
        <a href="{{ route('admin.produits-vendre') }}"
           class="bg-white shadow hover:shadow-lg transition rounded-lg p-6 flex items-center gap-4 border border-gray-200">
            <div class="bg-red-100 text-red-600 p-3 rounded-full">
                🛒
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Produits à vendre</h3>
                <p class="text-gray-500 text-sm">Gérer les produits disponibles</p>
            </div>
        </a>

        <!-- Rendez-vous -->
        <a href="{{ route('admin.rendezvous.index') }}"
           class="bg-white shadow hover:shadow-lg transition rounded-lg p-6 flex items-center gap-4 border border-gray-200">
            <div class="bg-purple-100 text-purple-600 p-3 rounded-full">
                📅
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Rendez-vous</h3>
                <p class="text-gray-500 text-sm">Voir les réservations</p>
            </div>
        </a>

        <!-- Commandes -->
        <a href="{{ route('admin.commandes') }}"
           class="bg-white shadow hover:shadow-lg transition rounded-lg p-6 flex items-center gap-4 border border-gray-200">
            <div class="bg-indigo-100 text-indigo-600 p-3 rounded-full">
                📦
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Commandes</h3>
                <p class="text-gray-500 text-sm">Gérer les commandes clients</p>
            </div>
        </a>

    </div>

@endsection


