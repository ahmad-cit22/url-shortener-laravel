@extends('layouts.master')

@section('content')
    <main class="flex-grow flex flex-col items-center justify-center px-4">
        <section class="bg-white rounded-lg shadow-lg p-8 w-full max-w-lg">
            <h2 class="text-2xl font-bold text-center text-indigo-900 mb-4">Forgot Your Password?</h2>
            <p class="text-center text-gray-600 mb-6">Enter your email and we will send you a link to reset your password.
            </p>
            <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-gray-700 font-medium">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email"
                        class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('email') border-red-500 @enderror"
                        required>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit"
                    class="w-full p-4 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition duration-200">
                    Send Reset Link
                </button>
            </form>
        </section>
    </main>
@endsection
