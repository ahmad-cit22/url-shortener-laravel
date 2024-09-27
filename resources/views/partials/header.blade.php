<header class="bg-white shadow-md">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <h1 class="text-3xl font-extrabold text-indigo-600">URLShort</h1>
        <nav class="space-x-6 flex items-center">
            <a href="{{ route('home') }}" class="text-gray-700 font-medium hover:text-indigo-500">Home</a>
            @auth
                <a href="{{ route('dashboard') }}" class="text-gray-700 font-medium hover:text-indigo-500">Dashboard</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-gray-700 font-medium hover:text-indigo-500">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-gray-700 font-medium hover:text-indigo-500">Login</a>
                <a href="{{ route('register') }}"
                    class="text-indigo-600 font-semibold hover:text-indigo-700 bg-gray-100 rounded-lg">Register</a>
            @endauth
        </nav>
    </div>
</header>
