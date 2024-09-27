@extends('layouts.master')

@section('content')
    <main class="flex-grow flex flex-col items-center justify-center px-4">
        <section class="bg-white rounded-lg shadow-lg p-8 w-full max-w-lg">
            <h2 class="text-2xl font-bold text-center text-indigo-900 mb-4">Login to Your Account</h2>
            <form action="{{ route('login') }}" method="POST" class="space-y-4">
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
                <div>
                    <label for="password" class="block text-gray-700 font-medium">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password"
                        class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('password') border-red-500 @enderror"
                        required>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-between items-center">
                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="remember" class="form-checkbox text-indigo-600">
                            <span class="ml-2 text-gray-700">Remember me</span>
                        </label>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-indigo-600 hover:underline">Forgot password?</a>
                </div>
                <button type="submit"
                    class="w-full p-4 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition duration-200">Login</button>
            </form>
        </section>
    </main>
@endsection
