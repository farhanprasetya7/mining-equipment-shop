@extends('layouts.app')

@section('title', 'Spare Parts - Mining Equipment Shop')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Spare Parts Alat Berat</h1>
        <p class="text-gray-600 dark:text-gray-400">Spare parts original dan berkualitas untuk semua jenis alat berat</p>
    </div>

    <!-- Search & Filter -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
        <form action="{{ route('spare-parts.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Search -->
            <div>
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Cari spare parts..."
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:text-white">
            </div>

            <!-- Category Filter -->
            <div>
                <select name="category_id" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:text-white">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Stock Status -->
            <div>
                <select name="in_stock" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:text-white">
                    <option value="">Semua Status</option>
                    <option value="1" {{ request('in_stock') == '1' ? 'selected' : '' }}>In Stock</option>
                    <option value="0" {{ request('in_stock') == '0' ? 'selected' : '' }}>Out of Stock</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Results Info & Add Button -->
    <div class="flex justify-between items-center mb-6">
        <p class="text-gray-600 dark:text-gray-400">
            Menampilkan {{ $spareParts->count() }} dari {{ $spareParts->total() }} spare parts
        </p>
        
        @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isSales()))
        <a href="{{ route('spare-parts.create') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg transition">
            <i class="fas fa-plus mr-2"></i>Tambah Spare Part
        </a>
        @endif
    </div>

    <!-- Spare Parts Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        @forelse($spareParts as $part)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
            <!-- Image -->
            <div class="relative h-48 bg-gray-200">
                @if($part->images && count($part->images) > 0)
                    <img src="{{ asset('storage/' . $part->images[0]) }}" alt="{{ $part->name }}" 
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                        <i class="fas fa-cog text-6xl"></i>
                    </div>
                @endif
                
                <!-- Stock Badge -->
                @if($part->stock_quantity > 0)
                    <span class="absolute top-2 right-2 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        In Stock
                    </span>
                @else
                    <span class="absolute top-2 right-2 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        Out of Stock
                    </span>
                @endif
            </div>

            <!-- Content -->
            <div class="p-4">
                <!-- Category -->
                <span class="text-xs text-gray-500 dark:text-gray-400 uppercase">
                    {{ $part->category->name }}
                </span>
                
                <!-- Title -->
                <h3 class="text-lg font-bold text-gray-800 dark:text-white mt-1 mb-2">
                    {{ $part->name }}
                </h3>
                
                <!-- Part Number -->
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-2">
                    <i class="fas fa-hashtag"></i> {{ $part->part_number }}
                </p>
                
                <!-- Stock -->
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                    <i class="fas fa-box"></i> Stock: {{ $part->stock_quantity }}
                </p>
                
                <!-- Price & Action -->
                <div class="flex justify-between items-center pt-3 border-t border-gray-200 dark:border-gray-700">
                    <div>
                        <p class="text-xl font-bold text-yellow-500">
                            Rp {{ number_format($part->price, 0, ',', '.') }}
                        </p>
                    </div>
                    <a href="{{ route('spare-parts.show', $part) }}" 
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg text-sm transition">
                        Detail
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-4 text-center py-12">
            <i class="fas fa-cog text-6xl text-gray-300 dark:text-gray-600 mb-4"></i>
            <p class="text-gray-600 dark:text-gray-400">Tidak ada spare parts yang ditemukan</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $spareParts->links() }}
    </div>
</div>
@endsection
