<header class="bg-white shadow-md">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <h1 class="text-3xl font-extrabold text-indigo-600">URL Shortener</h1>

        <button id="menu-toggle" class="lg:hidden focus:outline-none" onclick="toggleMenu()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Navbar for desktop -->
        <nav class="hidden lg:flex space-x-6 items-center">
            <a href="{{ route('home') }}" class="text-gray-700 font-medium hover:text-indigo-500 {{ request()->routeIs('home') ? 'text-indigo-600' : '' }}">Home</a>
            @auth

                <div class="relative">
                    <button onclick="toggleDropdown()"
                        class="flex items-center text-indigo-600 font-semibold hover:text-indigo-700 bg-gray-100 px-4 py-2 rounded-lg focus:outline-none">
                        Dashboard
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div id="dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg hidden">
                        <a href="{{ route('dashboard') }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('dashboard') ? 'bg-gray-100' : '' }}">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
            @endauth
            @guest
                <a href="{{ route('login') }}"
                    class="text-gray-700 font-medium hover:text-indigo-500 {{ request()->routeIs('login') ? 'text-indigo-600' : '' }}">Login</a>
                <a href="{{ route('register') }}"
                    class="font-semibold hover:text-indigo-700 bg-indigo-100 px-4 py-2 rounded-lg {{ request()->routeIs('register') ? 'bg-indigo-500 text-white' : '' }}">Register</a>
            @endguest
        </nav>
    </div>

    <!-- Mobile menu -->
    <nav id="mobile-menu" class="hidden lg:hidden bg-white">
        <div class="px-6 py-4 space-y-4">
            <a href="{{ route('home') }}"
                class="block text-gray-700 font-medium hover:bg-gray-100 p-2 rounded-lg {{ request()->routeIs('home') ? 'bg-gray-100' : '' }}">Home</a>
            @auth
                <a href="{{ route('dashboard') }}"
                    class="block text-indigo-600 font-semibold hover:bg-gray-100 py-2 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-gray-100' : '' }}">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" class="block">
                    @csrf
                    <button type="submit"
                        class="w-full text-left text-indigo-600 font-semibold hover:bg-gray-100 py-2 rounded-lg">Logout</button>
                </form>
            @endauth
            @guest
                <a href="{{ route('login') }}"
                    class="block text-gray-700 font-medium hover:bg-gray-100 p-2 rounded-lg {{ request()->routeIs('login') ? 'bg-gray-100' : '' }}">Login</a>
                <a href="{{ route('register') }}"
                    class="block text-indigo-600 font-semibold hover:bg-gray-100 p-2 rounded-lg {{ request()->routeIs('register') ? 'bg-gray-100' : '' }}">Register</a>
            @endguest
        </div>
    </nav>
</header>
