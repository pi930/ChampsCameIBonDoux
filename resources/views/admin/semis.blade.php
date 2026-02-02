@extends('layouts.admin')

@section('content')

    <h1 class="text-3xl font-bold mb-8">Sélection des semis</h1>

    <form action="{{ route('admin.semis.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Semis disponibles</h2>

            <div class="space-y-3">
                @foreach($semis as $s)
                    <label class="flex items-center justify-between bg-gray-50 hover:bg-gray-100 p-3 rounded-lg border border-gray-200 cursor-pointer">
                        <div class="flex items-center gap-3">
                            <input
                                type="checkbox"
                                name="semis[]"
                                value="{{ $s->id }}"
                                @checked($s->selectionne)
                                class="h-5 w-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
                            >
                            
                            <span class="text-gray-800 font-medium">
                                {{ $s->produit->nom }}
                            </span>
                        </div>

                        <span class="text-sm text-gray-500">
                            #{{ $s->id }}
                        </span>
                    </label>
                @endforeach
            </div>
        </div>

        <button
            type="submit"
            class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow"
        >
            Générer les produits à vendre
        </button>

        <a href="{{ route('admin.produits-vendre') }}"
   class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow">
    Voir les produits à vendre
</a>

    </form>

@endsection


