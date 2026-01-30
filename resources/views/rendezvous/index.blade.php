<x-app-layout>

<div class="max-w-3xl mx-auto py-10">

    <h1 class="text-2xl font-bold mb-6">Choisissez un rendez-vous</h1>

    <form action="{{ route('rendezvous.choisir') }}" method="POST"
          class="bg-white shadow p-6 rounded-lg space-y-4">
        @csrf

        @foreach($rendezvous as $rdv)
            <label class="flex items-center space-x-3 p-3 border rounded hover:bg-gray-50">
                <input type="radio" name="rendezvous_id" value="{{ $rdv->id }}" class="h-5 w-5 text-blue-600">
                <span class="text-lg">
                    {{ $rdv->date }} à {{ $rdv->heure }}
                </span>
            </label>
        @endforeach

        <button type="submit"
                class="w-full mt-4 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
            Valider ce rendez-vous
        </button>
    </form>

</div>

</x-app-layout>


