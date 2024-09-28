<header class="bg-white shadow-md">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <a href="{{ route('home') }}" class="flex items-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo"
                class="h-8 w-auto sm:h-10 sm:w-auto object-cover object-center rounded-full sm:mr-4" />
            <h1 class="text-3xl font-extrabold text-indigo-600">URLShort</h1>
        </a>
        <nav class="space-x-6 flex items-center">
            <a href="{{ route('home') }}" class="text-gray-700 font-medium hover:text-indigo-500 {{ request()->routeIs('home') ? 'text-indigo-600' : '' }}">Home</a>
            @auth
                <a href="{{ route('dashboard') }}" class="text-gray-700 font-medium hover:text-indigo-500 {{ request()->routeIs('dashboard') ? 'text-indigo-600' : '' }}">Dashboard</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-red-600 font-medium hover:text-indigo-500">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-gray-700 font-medium hover:text-indigo-500 {{ request()->routeIs('login') ? 'text-indigo-600' : '' }}">Login</a>
                <a href="{{ route('register') }}"
                    class="text-white font-semibold hover:text-white bg-indigo-500 hover:bg-indigo-600 rounded-lg px-4 py-2 text-sm transition duration-200">Register</a>
            @endauth
        </nav>
    </div>
</header>
