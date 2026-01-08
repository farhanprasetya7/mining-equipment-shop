@extends('layouts.app')

@section('title', $sparePart->name . ' - Mining Equipment Shop')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-6 text-sm">
        <ol class="flex items-center space-x-2 text-gray-600 dark:text-gray-400">
            <li><a href="{{ route('home') }}" class="hover:text-yellow-500">Home</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li><a href="{{ route('spare-parts.index') }}" class="hover:text-yellow-500">Spare Parts</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li class="text-gray-800 dark:text-white">{{ $sparePart->name }}</li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Images -->
        <div>
            <div class="bg-gray-200 dark:bg-gray-700 rounded-lg overflow-hidden mb-4" x-data="{ selectedImage: 0 }">
                <div class="relative h-96">
                    @if($sparePart->images && count($sparePart->images) > 0)
                        <template x-for="(image, index) in {{ json_encode($sparePart->images) }}" :key="index">
                            <img :src="'/storage/' + image" alt="{{ $sparePart->name }}" 
                                 class="w-full h-full object-cover absolute inset-0"
                                 x-show="selectedImage === index">
                        </template>
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <i class="fas fa-cog text-9xl"></i>
                        </div>
                    @endif
                </div>

                @if($sparePart->images && count($sparePart->images) > 1)
                <div class="grid grid-cols-4 gap-2 mt-4">
                    @foreach($sparePart->images as $index => $image)
                    <div class="cursor-pointer border-2 rounded-lg overflow-hidden"
                         :class="selectedImage === {{ $index }} ? 'border-yellow-500' : 'border-gray-300'"
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
            <!-- Stock Badge -->
            <div class="mb-3">
                @if($sparePart->stock_quantity > 0)
                    <span class="bg-green-500 text-white px-4 py-1 rounded-full text-sm font-semibold">
                        <i class="fas fa-check-circle mr-1"></i>In Stock
                    </span>
                @else
                    <span class="bg-red-500 text-white px-4 py-1 rounded-full text-sm font-semibold">
                        <i class="fas fa-times-circle mr-1"></i>Out of Stock
                    </span>
                @endif
            </div>

            <!-- Title -->
            <h1 class="text-4xl font-bold text-gray-800 dark:text-white mb-2">{{ $sparePart->name }}</h1>
            
            <!-- Category & Part Number -->
            <p class="text-gray-600 dark:text-gray-400 mb-2">
                <i class="fas fa-tag mr-1"></i>{{ $sparePart->category->name }}
            </p>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
                <i class="fas fa-hashtag mr-1"></i>Part Number: <strong>{{ $sparePart->part_number }}</strong>
            </p>

            <!-- Price -->
            <div class="bg-yellow-50 dark:bg-yellow-900/20 border-2 border-yellow-500 rounded-lg p-6 mb-6">
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-1">Harga</p>
                <p class="text-4xl font-bold text-yellow-500">Rp {{ number_format($sparePart->price, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                    <i class="fas fa-box mr-1"></i>Stock: <strong>{{ $sparePart->stock_quantity }}</strong> units
                </p>
            </div>

            <!-- Specifications -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Spesifikasi</h3>
                <div class="space-y-3">
                    @if($sparePart->brand)
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Brand</span>
                        <span class="font-semibold text-gray-800 dark:text-white">{{ $sparePart->brand }}</span>
                    </div>
                    @endif
                    @if($sparePart->compatible_models)
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Compatible Models</span>
                        <span class="font-semibold text-gray-800 dark:text-white">{{ $sparePart->compatible_models }}</span>
                    </div>
                    @endif
                    @if($sparePart->warranty_period)
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Warranty</span>
                        <span class="font-semibold text-gray-800 dark:text-white">{{ $sparePart->warranty_period }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Weight</span>
                        <span class="font-semibold text-gray-800 dark:text-white">{{ $sparePart->weight ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="space-y-3">
                @if(auth()->check() && auth()->user()->isCustomer() && $sparePart->stock_quantity > 0)
                    <div x-data="{ quantity: 1 }">
                        <div class="flex items-center gap-3 mb-3">
                            <label class="text-gray-700 dark:text-gray-300 font-semibold">Quantity:</label>
                            <div class="flex items-center border border-gray-300 dark:border-gray-600 rounded-lg">
                                <button @click="quantity = Math.max(1, quantity - 1)" 
                                        class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" x-model="quantity" min="1" :max="{{ $sparePart->stock_quantity }}"
                                       class="w-20 text-center border-0 focus:ring-0 dark:bg-gray-800 dark:text-white">
                                <button @click="quantity = Math.min({{ $sparePart->stock_quantity }}, quantity + 1)" 
                                        class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button @click="addToOrder({{ $sparePart->id }}, quantity)" 
                                class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-4 rounded-lg transition">
                            <i class="fas fa-shopping-cart mr-2"></i>Add to Cart
                        </button>
                    </div>
                @elseif(!auth()->check())
                    <a href="{{ route('login') }}" 
                       class="block w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-4 rounded-lg text-center transition">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login to Order
                    </a>
                @endif

                @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isSales()))
                <div class="flex gap-3">
                    <a href="{{ route('spare-parts.edit', $sparePart) }}" 
                       class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 rounded-lg text-center transition">
                        <i class="fas fa-edit mr-2"></i>Edit
                    </a>
                    <form action="{{ route('spare-parts.destroy', $sparePart) }}" method="POST" class="flex-1">
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
    @if($sparePart->description)
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Deskripsi</h2>
        <div class="text-gray-600 dark:text-gray-400 leading-relaxed">
            {!! nl2br(e($sparePart->description)) !!}
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script>
function addToOrder(partId, quantity) {
    alert(`Adding ${quantity} units to cart. Order functionality will be implemented with checkout page`);
}
</script>
@endpush
@endsection
