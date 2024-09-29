@extends('layouts.master')

@section('content')
    <main class="flex-grow flex flex-col items-center justify-center px-4 mt-5">

        <!-- form section -->
        <section class="bg-white rounded-lg shadow-lg p-8 w-full max-w-lg mb-12">
            <h2 class="text-2xl font-bold text-center text-indigo-900 mb-4">Shorten Your URL</h2>
            <p class="text-center text-gray-600 mb-6">We're happy to make your long URLs shorter! </p>

            <!-- form -->
            <form id="url-form" action="{{ route('url.shorten') }}" method="POST" class="space-y-4">
                @csrf
                <div class="relative">
                    <input type="url" id="original-url" name="original_url" placeholder="Enter your long URL here"
                        class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        required>
                    <small class="absolute top-1/2 transform -translate-y-1/2 right-4 text-gray-400 hidden lg:inline">e.g.
                        https://example.com</small>
                </div>
                <button type="submit"
                    class="w-full p-4 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition duration-200">
                    Shorten URL
                </button>
            </form>

            <!-- Shortened URL section -->
            @if (session('shortUrl'))
                <div id="shortened-url" class="mt-8 p-6 bg-indigo-50 shadow-md rounded-lg">
                    <div class="text-center overflow-hidden">
                        <p class="text-gray-600 font-semibold">Original URL:</p>
                        <a href="{{ session('originalUrl') }}"
                            class="text-indigo-500 font-medium hover:underline break-all truncate max-w-xs"
                            title="{{ session('originalUrl') }}">
                            {{ Str::limit(session('originalUrl'), 37) }}
                        </a>
                    </div>

                    <div class="mt-4 text-center">
                        <p class="text-gray-600 font-semibold">Your Shortened URL:</p>
                        <div class="inline-flex items-center space-x-2 justify-center">
                            <a href="{{ route('url.redirect', session('shortUrl')) }}"
                                class="text-indigo-500 font-medium hover:underline break-all">
                                {{ route('url.redirect', session('shortUrl')) }}
                            </a>

                            <button id="copyBtn"
                                onclick="copyToClipboard('{{ route('url.redirect', session('shortUrl')) }}')"
                                class="bg-indigo-500 text-white py-1 px-2 text-sm rounded-md hover:bg-indigo-600 flex items-center space-x-1">

                                <svg id="copyIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8 16h8M8 12h8m-6 4h6M6 20h12M8 8h8M6 4h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2z" />
                                </svg>
                                <span id="copyText">Copy</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            <!-- errors -->
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
                To track click counts and manage your created links, you can sign up for an account and access more
                features.
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

@push('custom-js')
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {

                document.getElementById('copyIcon').outerHTML = `
                <svg id="checkIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>`;
                document.getElementById('copyText').innerText = "Copied";

                setTimeout(() => {
                    document.getElementById('checkIcon').outerHTML = `
                    <svg id="copyIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 16h8M8 12h8m-6 4h6M6 20h12M8 8h8M6 4h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2z" />
                    </svg>`;
                    document.getElementById('copyText').innerText = "Copy";
                }, 2000);

                showAlert();
            }, function(err) {
                console.error('Failed to copy text: ', err);
            });
        }
    </script>
@endpush
