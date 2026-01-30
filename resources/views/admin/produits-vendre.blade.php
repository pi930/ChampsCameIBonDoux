@extends('layouts.admin')

@section('content')
   



<h1>Produits à vendre</h1>

<form method="POST" action="{{ route('admin.produits-vendre.store') }}" class="space-y-6">
    @csrf

    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Produits disponibles</h2>

        <div class="space-y-3">
            @foreach ($semis as $s)
                <label class="flex items-center justify-between bg-gray-50 hover:bg-gray-100 p-3 rounded-lg border border-gray-200 cursor-pointer">
                    <div class="flex items-center gap-3">
                        <input
                            type="checkbox"
                            name="produits[]"
                            value="{{ $s->id }}"
                            @checked(in_array($s->id, $actifs))
                            class="h-5 w-5 text-green-600 rounded border-gray-300 focus:ring-green-500"
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
        class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow"
    >
        Mettre à jour
    </button>
    @if(session('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

</form>
@endsection