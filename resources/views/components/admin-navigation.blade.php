<nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">

        {{-- Logo / Titre --}}
        <div class="text-xl font-bold text-gray-800">
            Admin
        </div>

        {{-- Boutons --}}
        <div class="flex items-center space-x-6">

            {{-- Dashboard --}}
            <a href="{{ route('admin.dashboard') }}"
               class="text-gray-700 hover:text-blue-600 font-medium">
                Dashboard
            </a>

            {{-- Panier (icône) --}}
            <a href="{{ route('home') }}"
               class="text-gray-700 hover:text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor"
                     class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25h9.75m-9.75 0L6.136 6.272A1.125 1.125 0 0 0 5.011 5.25H3m4.5 9l1.125 6.75m9.75-6.75-1.125 6.75m-8.625 0h9.75" />
                </svg>
            </a>

        </div>
    </div>
</nav>

