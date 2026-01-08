@extends('layouts.app')

@section('title', $vehicle->name . ' - Mining Equipment Shop')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-6 text-sm">
        <ol class="flex items-center space-x-2 text-gray-600 dark:text-gray-400">
            <li><a href="{{ route('home') }}" class="hover:text-yellow-500">Home</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li><a href="{{ route('vehicles.index') }}" class="hover:text-yellow-500">Vehicles</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li class="text-gray-800 dark:text-white">{{ $vehicle->name }}</li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Images -->
        <div>
            <!-- Main Image -->
            <div class="bg-gray-200 dark:bg-gray-700 rounded-lg overflow-hidden mb-4" x-data="{ selectedImage: 0 }">
                <div class="relative h-96">
                    @if($vehicle->images && count($vehicle->images) > 0)
                        <template x-for="(image, index) in {{ json_encode($vehicle->images) }}" :key="index">
                            <img :src="'/storage/' + image" alt="{{ $vehicle->name }}" 
                                 class="w-full h-full object-cover absolute inset-0"
                                 x-show="selectedImage === index">
                        </template>
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <i class="fas fa-truck-monster text-9xl"></i>
                        </div>
                    @endif
                </div>

                <!-- Thumbnails -->
                @if($vehicle->images && count($vehicle->images) > 1)
                <div class="grid grid-cols-4 gap-2 mt-4">
                    @foreach($vehicle->images as $index => $image)
                    <div class="cursor-pointer border-2 rounded-lg overflow-hidden"
                         :class="selectedImage === {{ $index }} ? 'border-yellow-500' : 'border-gray-300 dark:border-gray-600'"
                         @click="selectedImage = {{ $index }}">
                        <img src="{{ asset('storage/' . $image) }}" alt="Thumbnail {{ $index + 1 }}" 
                             class="w-full h-20 object-cover">
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        <!-- Details -->
        <div>
            <!-- Status & Featured Badges -->
            <div class="flex gap-2 mb-3">
                <span class="px-4 py-1 rounded-full text-sm font-semibold
                    @if($vehicle->status == 'available') bg-green-500 text-white
                    @elseif($vehicle->status == 'sold') bg-red-500 text-white
                    @else bg-yellow-500 text-white
                    @endif">
                    {{ ucfirst($vehicle->status) }}
                </span>
                @if($vehicle->is_featured)
                <span class="bg-yellow-500 text-white px-4 py-1 rounded-full text-sm font-semibold">
                    <i class="fas fa-star mr-1"></i>Featured
                </span>
                @endif
            </div>

            <!-- Title -->
            <h1 class="text-4xl font-bold text-gray-800 dark:text-white mb-2">{{ $vehicle->name }}</h1>
            
            <!-- Category -->
            <p class="text-gray-600 dark:text-gray-400 mb-4">
                <i class="fas fa-tag mr-1"></i>{{ $vehicle->category->name }}
            </p>

            <!-- Rating -->
            @if($vehicle->averageRating() > 0)
            <div class="flex items-center mb-4">
                <div class="flex text-yellow-500 mr-2">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $vehicle->averageRating())
                            <i class="fas fa-star"></i>
                        @else
                            <i class="far fa-star"></i>
                        @endif
                    @endfor
                </div>
                <span class="text-gray-600 dark:text-gray-400">
                    {{ number_format($vehicle->averageRating(), 1) }} ({{ $vehicle->reviews->count() }} reviews)
                </span>
            </div>
            @endif

            <!-- Price -->
            <div class="bg-yellow-50 dark:bg-yellow-900/20 border-2 border-yellow-500 rounded-lg p-6 mb-6">
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-1">Harga</p>
                <p class="text-4xl font-bold text-yellow-500">Rp {{ number_format($vehicle->price, 0, ',', '.') }}</p>
            </div>

            <!-- Specifications -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Spesifikasi</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Brand</p>
                        <p class="font-semibold text-gray-800 dark:text-white">{{ $vehicle->brand }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Model</p>
                        <p class="font-semibold text-gray-800 dark:text-white">{{ $vehicle->model }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Tahun</p>
                        <p class="font-semibold text-gray-800 dark:text-white">{{ $vehicle->year }}</p>
                    </div>
                    @if($vehicle->engine_capacity)
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Engine Capacity</p>
                        <p class="font-semibold text-gray-800 dark:text-white">{{ $vehicle->engine_capacity }}</p>
                    </div>
                    @endif
                    @if($vehicle->fuel_type)
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Fuel Type</p>
                        <p class="font-semibold text-gray-800 dark:text-white">{{ $vehicle->fuel_type }}</p>
                    </div>
                    @endif
                    @if($vehicle->condition)
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Condition</p>
                        <p class="font-semibold text-gray-800 dark:text-white">{{ ucfirst($vehicle->condition) }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Actions -->
            <div class="space-y-3">
                @if(auth()->check() && auth()->user()->isCustomer() && $vehicle->status == 'available')
                    <button onclick="addToOrder({{ $vehicle->id }})" 
                            class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-4 rounded-lg transition">
                        <i class="fas fa-shopping-cart mr-2"></i>Order Now
                    </button>
                @elseif(!auth()->check())
                    <a href="{{ route('login') }}" 
                       class="block w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-4 rounded-lg text-center transition">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login to Order
                    </a>
                @endif

                @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isSales()))
                <div class="flex gap-3">
                    <a href="{{ route('vehicles.edit', $vehicle) }}" 
                       class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 rounded-lg text-center transition">
                        <i class="fas fa-edit mr-2"></i>Edit
                    </a>
                    <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')"
                                class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-3 rounded-lg transition">
                            <i class="fas fa-trash mr-2"></i>Delete
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Description -->
    @if($vehicle->description)
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Deskripsi</h2>
        <div class="text-gray-600 dark:text-gray-400 leading-relaxed">
            {!! nl2br(e($vehicle->description)) !!}
        </div>
    </div>
    @endif

    <!-- Reviews -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Reviews</h2>
        
        @if($vehicle->reviews->count() > 0)
        <div class="space-y-4">
            @foreach($vehicle->reviews as $review)
            <div class="border-b border-gray-200 dark:border-gray-700 pb-4 last:border-0">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center">
                        <img src="{{ $review->user->profile_photo ?? 'https://ui-avatars.com/api/?name=' . urlencode($review->user->name) }}" 
                             class="w-10 h-10 rounded-full mr-3">
                        <div>
                            <p class="font-semibold text-gray-800 dark:text-white">{{ $review->user->name }}</p>
                            <div class="flex text-yellow-500 text-sm">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ $review->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-gray-600 dark:text-gray-400">{{ $review->comment }}</p>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-center text-gray-500 dark:text-gray-400 py-8">Belum ada review</p>
        @endif
    </div>
</div>

@push('scripts')
<script>
function addToOrder(vehicleId) {
    // Implement order functionality
    alert('Order functionality will be implemented with checkout page');
}
</script>
@endpush
@endsection
