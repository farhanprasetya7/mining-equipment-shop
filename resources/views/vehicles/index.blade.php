@extends('layouts.app')

@section('title', 'Vehicles - Mining Equipment Shop')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Kendaraan Alat Berat</h1>
        <p class="text-gray-600 dark:text-gray-400">Temukan kendaraan alat berat terbaik untuk proyek tambang Anda</p>
    </div>

    <!-- Search & Filter -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
        <form action="{{ route('vehicles.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Search -->
            <div>
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Cari kendaraan..."
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

            <!-- Status Filter -->
            <div>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:text-white">
                    <option value="">Semua Status</option>
                    <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                    <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
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
            Menampilkan {{ $vehicles->count() }} dari {{ $vehicles->total() }} kendaraan
        </p>
        
        @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isSales()))
        <a href="{{ route('vehicles.create') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg transition">
            <i class="fas fa-plus mr-2"></i>Tambah Kendaraan
        </a>
        @endif
    </div>

    <!-- Vehicles Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        @forelse($vehicles as $vehicle)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
            <!-- Image -->
            <div class="relative h-48 bg-gray-200">
                @php
                    $images = $vehicle->images;
                    if (is_string($images)) {
                        $images = json_decode($images, true) ?? [];
                    }
                    $images = is_array($images) ? $images : [];
                @endphp
                @if(!empty($images) && count($images) > 0)
                    <img src="{{ asset('storage/' . $images[0]) }}" alt="{{ $vehicle->name }}" 
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                        <i class="fas fa-truck-monster text-6xl"></i>
                    </div>
                @endif
                
                <!-- Status Badge -->
                <span class="absolute top-2 right-2 px-3 py-1 rounded-full text-sm font-semibold
                    @if($vehicle->status == 'available') bg-green-500 text-white
                    @elseif($vehicle->status == 'sold') bg-red-500 text-white
                    @else bg-yellow-500 text-white
                    @endif">
                    {{ ucfirst($vehicle->status) }}
                </span>
                
                @if($vehicle->is_featured)
                <span class="absolute top-2 left-2 bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                    <i class="fas fa-star mr-1"></i>Featured
                </span>
                @endif
            </div>

            <!-- Content -->
            <div class="p-6">
                <!-- Category -->
                <span class="text-xs text-gray-500 dark:text-gray-400 uppercase">
                    {{ $vehicle->category->name }}
                </span>
                
                <!-- Title -->
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mt-1 mb-2">
                    {{ $vehicle->name }}
                </h3>
                
                <!-- Brand & Model -->
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-3">
                    {{ $vehicle->brand }} - {{ $vehicle->model }} ({{ $vehicle->year }})
                </p>
                
                <!-- Specs -->
                <div class="space-y-1 mb-4 text-sm text-gray-600 dark:text-gray-400">
                    @if($vehicle->engine_capacity)
                    <p><i class="fas fa-cog w-4"></i> {{ $vehicle->engine_capacity }}</p>
                    @endif
                    <p><i class="fas fa-eye w-4"></i> {{ $vehicle->views }} views</p>
                    @if($vehicle->averageRating() > 0)
                    <p><i class="fas fa-star text-yellow-500 w-4"></i> {{ number_format($vehicle->averageRating(), 1) }} ({{ $vehicle->reviews->count() }} reviews)</p>
                    @endif
                </div>
                
                <!-- Price & Action -->
                <div class="flex justify-between items-center pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div>
                        <p class="text-2xl font-bold text-yellow-500">
                            Rp {{ number_format($vehicle->price, 0, ',', '.') }}
                        </p>
                    </div>
                    <a href="{{ route('vehicles.show', $vehicle) }}" 
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition">
                        Detail
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-12">
            <i class="fas fa-truck-monster text-6xl text-gray-300 dark:text-gray-600 mb-4"></i>
            <p class="text-gray-600 dark:text-gray-400">Tidak ada kendaraan yang ditemukan</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $vehicles->links() }}
    </div>
</div>
@endsection
