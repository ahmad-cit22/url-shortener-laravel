<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        // Dark Mode Toggle Script
        function toggleDarkMode() {
            document.documentElement.classList.toggle('dark');
            if (localStorage.theme === 'dark') {
                localStorage.theme = 'light';
            } else {
                localStorage.theme = 'dark';
            }
        }

        // Load dark mode preference from localStorage
        if (localStorage.theme === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
    <style>
        /* Custom dark mode styles */
        .dark body {
            background-color: #1a202c;
            color: #e2e8f0;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between">

    <!-- Header -->
    <header class="bg-white dark:bg-gray-800 shadow-md">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-3xl font-extrabold text-indigo-600 dark:text-indigo-400">URL Shortener</h1>
            <nav class="space-x-6 flex items-center">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-700 dark:text-gray-300 font-medium hover:text-indigo-500 dark:hover:text-indigo-400">Dashboard</a>
                @endauth
                <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 font-medium hover:text-indigo-500 dark:hover:text-indigo-400">Login</a>
                <a href="{{ route('register') }}" class="text-indigo-600 font-semibold hover:text-indigo-700 dark:text-indigo-400 bg-gray-100 dark:bg-gray-700 px-4 py-2 rounded-lg">Register</a>
                <button onclick="toggleDarkMode()" class="text-gray-700 dark:text-gray-300 hover:text-indigo-500 dark:hover:text-indigo-400 bg-gray-200 dark:bg-gray-700 px-3 py-1 rounded-lg">
                    Toggle Dark Mode
                </button>
            </nav>
        </div>
    </header>

    <!-- Main Section -->
    <main class="flex-grow flex flex-col items-center justify-center px-4">
        <!-- URL Shortener Form Section -->
        <section class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 w-full max-w-lg mb-12">
            <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-gray-100 mb-4">Shorten Your URL</h2>
            <p class="text-center text-gray-600 dark:text-gray-400 mb-6">Easily shorten long URLs and share them with others.</p>
            <form id="url-form" action="" method="POST" class="space-y-4">
                @csrf
                <div class="relative">
                    <input type="url" id="long-url" name="long_url" placeholder="Enter your long URL here"
                           class="w-full p-4 border border-gray-300 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-100"
                           required>
                    <small class="absolute top-1/2 transform -translate-y-1/2 right-4 text-gray-400 dark:text-gray-500">e.g. https://example.com</small>
                </div>
                <button type="submit"
                        class="w-full p-4 bg-indigo-600 dark:bg-indigo-500 text-white font-semibold rounded-lg hover:bg-indigo-700 dark:hover:bg-indigo-600 transition duration-200">
                    Shorten URL
                </button>
            </form>
            @if (1)
                <div id="shortened-url" class="mt-6 bg-indigo-50 dark:bg-gray-700 p-4 rounded-lg">
                    <p class="text-center text-gray-700 dark:text-gray-200">Your shortened URL:</p>
                    <a href="456456456456" class="text-indigo-600 dark:text-indigo-400 font-medium hover:underline block text-center">
                        456456456456
                    </a>
                </div>
            @endif
        </section>

        <!-- Info Section -->
        <section class="text-center max-w-lg">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Manage and Track Your Links</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-6">
                To track click counts and manage your created links, sign up for an account and access more features.
            </p>
            <a href="{{ route('register') }}"
               class="inline-block px-6 py-3 bg-indigo-600 dark:bg-indigo-500 text-white font-medium rounded-lg hover:bg-indigo-700 dark:hover:bg-indigo-600 transition duration-200">
                Register Now
            </a>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-white dark:bg-gray-800 shadow-md">
        <div class="container mx-auto px-6 py-4 text-center">
            <p class="text-gray-600 dark:text-gray-400 text-sm">&copy; 2024 URL Shortener. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
