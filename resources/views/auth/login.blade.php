@extends('layouts.app')

@section('title', 'Login - Mining Equipment Shop')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <i class="fas fa-truck-monster text-5xl text-yellow-500 mb-4"></i>
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white">Welcome Back!</h2>
                <p class="text-gray-600 dark:text-gray-400 mt-2">Login ke akun Anda</p>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">
                        <i class="fas fa-envelope mr-2"></i>Email
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent dark:bg-gray-700 dark:text-white @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">
                        <i class="fas fa-lock mr-2"></i>Password
                    </label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent dark:bg-gray-700 dark:text-white @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-yellow-500 focus:ring-yellow-500">
                        <span class="ml-2 text-gray-600 dark:text-gray-400">Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-yellow-500 hover:text-yellow-600 text-sm">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 rounded-lg transition">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </button>

                <!-- Register Link -->
                <div class="text-center mt-6">
                    <span class="text-gray-600 dark:text-gray-400">Belum punya akun?</span>
                    <a href="{{ route('register') }}" class="text-yellow-500 hover:text-yellow-600 font-semibold ml-1">
                        Daftar Sekarang
                    </a>
                </div>
            </form>

            <!-- Demo Credentials -->
            <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                <p class="text-center text-sm text-gray-600 dark:text-gray-400 mb-3">Demo Credentials:</p>
                <div class="space-y-2 text-xs text-gray-500 dark:text-gray-500">
                    <p><strong>Admin:</strong> admin@example.com / password123</p>
                    <p><strong>Sales:</strong> sales@example.com / password123</p>
                    <p><strong>Customer:</strong> customer@example.com / password123</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
