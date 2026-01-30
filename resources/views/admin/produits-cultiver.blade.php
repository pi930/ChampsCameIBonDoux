@extends('layouts.admin')

@section('content')

    <h1 class="text-3xl font-bold mb-8">Produits à cultiver</h1>

    <form action="{{ route('admin.semis.store') }}" method="POST">
        @csrf

        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Liste des produits</h2>

            <div class="space-y-3">
                    @foreach($produits as $p)
    <label class="flex items-center justify-between bg-gray-50 hover:bg-gray-100 p-3 rounded-lg border border-gray-200 cursor-pointer">
        <div class="flex items-center gap-3">

            <img
                src="{{ asset('storage/produits/' . $p->image) }}"
                alt="{{ $p->nom }}"
                class="h-12 w-12 object-cover rounded"
            >

            <input
                type="checkbox"
                name="produits[]"
                value="{{ $p->id }}"
                @checked($p->selectionne)
                class="h-5 w-5 text-green-600 rounded border-gray-300 focus:ring-green-500"
            >

            <span class="text-gray-800 font-medium">
                {{ $p->nom }}
            </span>
        </div>

        <span class="text-sm text-gray-500">
            #{{ $p->id }}
        </span>
    </label>
@endforeach

            </div>
        </div>

        <button
            type="submit"
            class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow"
        >
            Générer la liste des semis
        </button>
    </form>

@endsection


