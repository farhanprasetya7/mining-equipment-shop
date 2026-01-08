@extends('layouts.app')

@section('title', 'Register - Mining Equipment Shop')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <i class="fas fa-truck-monster text-5xl text-yellow-500 mb-4"></i>
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white">Buat Akun Baru</h2>
                <p class="text-gray-600 dark:text-gray-400 mt-2">Mulai belanja alat berat sekarang</p>
            </div>

            <!-- Register Form -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">
                        <i class="fas fa-user mr-2"></i>Nama Lengkap
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent dark:bg-gray-700 dark:text-white @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">
                        <i class="fas fa-envelope mr-2"></i>Email
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent dark:bg-gray-700 dark:text-white @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">
                        <i class="fas fa-phone mr-2"></i>Nomor Telepon
                    </label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent dark:bg-gray-700 dark:text-white @error('phone') border-red-500 @enderror">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Company -->
                <div class="mb-4">
                    <label for="company" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">
                        <i class="fas fa-building mr-2"></i>Nama Perusahaan (Optional)
                    </label>
                    <input type="text" id="company" name="company" value="{{ old('company') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent dark:bg-gray-700 dark:text-white">
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">
                        <i class="fas fa-lock mr-2"></i>Password
                    </label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent dark:bg-gray-700 dark:text-white @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">
                        <i class="fas fa-lock mr-2"></i>Konfirmasi Password
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent dark:bg-gray-700 dark:text-white">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 rounded-lg transition">
                    <i class="fas fa-user-plus mr-2"></i>Daftar
                </button>

                <!-- Login Link -->
                <div class="text-center mt-6">
                    <span class="text-gray-600 dark:text-gray-400">Sudah punya akun?</span>
                    <a href="{{ route('login') }}" class="text-yellow-500 hover:text-yellow-600 font-semibold ml-1">
                        Login Sekarang
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
