<x-guest-layout>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" type="email" name="email" class="mt-1 block w-full" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Mot de passe" />
            <x-text-input id="password" type="password" name="password" class="mt-1 block w-full" />
        </div>

        <div class="mt-4 flex justify-end">
            <x-primary-button>
                Connexion
            </x-primary-button>
        </div>

    </form>

</x-guest-layout>
