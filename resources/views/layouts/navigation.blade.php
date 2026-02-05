<nav x-data="{ open: false }" class="bg-white border-b border-gray-200">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="text-3xl font-bold text-green-700">
                    🧺 ChampsCameIBonDoux
                </a>
            </div>

            <!-- Right side (desktop) -->
            <div class="hidden sm:flex sm:items-center space-x-6">

                <a href="{{ route('panier.recap') }}" class="text-3xl hover:opacity-70">
                    🧺
                </a>

                @guest
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-green-700">Connexion</a>
                    <a href="{{ route('register') }}" class="text-gray-700 hover:text-green-700">Inscription</a>
                @endguest

                @auth
                    <div class="relative" x-data="{ userMenu: false }">
                        <button @click="userMenu = !userMenu" class="text-3xl hover:opacity-70">
                            👤
                        </button>

                        <div x-show="userMenu"
                             @click.outside="userMenu = false"
                             class="absolute right-0 mt-2 bg-white shadow rounded-lg p-3 w-48 z-50">

                            <a href="{{ route('profile.edit') }}" class="block py-1 hover:text-green-700">Profil</a>
                            <a href="{{ route('commandes.index') }}" class="block py-1 hover:text-green-700">Commandes</a>
                            <a href="{{ route('contact') }}" class="block py-1 hover:text-green-700">Contact</a>
                            <a href="{{ route('rendezvous.index') }}" class="block py-1 hover:text-green-700">Rendez-vous</a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="block w-full text-left py-1 text-red-600 hover:text-red-800">
                                    Déconnexion
                                </button>
                            </form>

                        </div>
                    </div>
                @endauth

            </div>

            <!-- Mobile menu button -->
            <div class="sm:hidden flex items-center">
                <button @click="open = !open" class="text-gray-600 text-3xl">☰</button>
            </div>

        </div>
    </div>

    <!-- Mobile menu (déplacé ici, en dehors du header) -->
    <div x-show="open" class="sm:hidden px-4 pb-4 space-y-2">
        <a href="{{ route('panier.recap') }}" class="block text-xl">🧺 Panier</a>

        @guest
            <a href="{{ route('login') }}" class="block text-gray-700">Connexion</a>
            <a href="{{ route('register') }}" class="block text-gray-700">Inscription</a>
        @endguest

        @auth
            <a href="{{ route('profile.edit') }}" class="block">Profil</a>
            <a href="{{ route('commandes.index') }}" class="block">Commandes</a>
            <a href="{{ route('contact') }}" class="block">Contact</a>
            <a href="{{ route('rendezvous.index') }}" class="block">Rendez-vous</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="block text-red-600">Déconnexion</button>
            </form>
        @endauth
    </div>

</nav>
