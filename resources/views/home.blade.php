@extends('layouts.master')

@section('content')
    <main class="flex-grow flex flex-col items-center justify-center px-4">

        <!-- Form Section -->
        <section class="bg-white rounded-lg shadow-lg p-8 w-full max-w-lg mb-12">
            <h2 class="text-2xl font-bold text-center text-indigo-900 mb-4">Shorten Your URL</h2>
            <p class="text-center text-gray-600 mb-6">We're happy to make your long URLs shorter! </p>

            <!-- Form -->
            <form id="url-form" action="{{ route('url.shorten') }}" method="POST" class="space-y-4">
                @csrf
                <div class="relative">
                    <input type="url" id="original-url" name="original_url" placeholder="Enter your long URL here"
                        class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        required>
                    <small class="absolute top-1/2 transform -translate-y-1/2 right-4 text-gray-400">e.g.
                        https://example.com</small>
                </div>
                <button type="submit"
                    class="w-full p-4 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition duration-200">
                    Shorten URL
                </button>
            </form>

            <!-- Shortened URL Section -->
            @if (session('shortUrl'))
                <div id="shortened-url" class="mt-6 bg-indigo-50 p-4 rounded-lg">
                    <p class="text-center text-gray-700">Your shortened URL:</p>
                    <a href="{{ route('url.redirect', session('shortUrl')) }}"
                        class="text-indigo-600 font-medium hover:underline block text-center">
                        {{ session('shortUrl') }}
                    </a>
                </div>
            @endif

            @if ($errors->any())
                <div class="mt-6 bg-red-50 p-4 rounded-lg">
                    <ul class="list-none">
                        @foreach ($errors->all() as $error)
                            <li class="text-red-600 font-medium">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </section>

        <!-- CTA Section -->
        <section class="text-center max-w-lg">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Manage and Track Your Links</h3>
            <p class="text-gray-600 mb-6">
                To track click counts and manage your created links, sign up for an account and access more features.
            </p>
            <a href="{{ route('register') }}"
                class="inline-block px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition duration-200">
                Register Now
            </a>

            <p class="text-gray-600 mt-6">Already have an account? <a href="{{ route('login') }}"
                    class="text-indigo-600 font-medium hover:underline">Login</a></p>
        </section>
    </main>
@endsection
