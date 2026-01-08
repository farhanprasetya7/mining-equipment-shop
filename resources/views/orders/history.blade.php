@extends('layouts.app')

@section('title', 'Order History - Mining Equipment Shop')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Order History</h1>
        <p class="text-gray-600 dark:text-gray-400">Track and manage your orders</p>
    </div>

    <!-- Filter -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
        <form action="{{ route('orders.history') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Status Filter -->
            <div>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:text-white">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <!-- Date From -->
            <div>
                <input type="date" name="date_from" value="{{ request('date_from') }}" 
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:text-white">
            </div>

            <!-- Date To -->
            <div>
                <input type="date" name="date_to" value="{{ request('date_to') }}" 
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:text-white">
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition">
                    <i class="fas fa-filter mr-2"></i>Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Orders List -->
    @if($orders->count() > 0)
    <div class="space-y-6">
        @foreach($orders as $order)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <!-- Order Header -->
            <div class="bg-gray-50 dark:bg-gray-700 p-6 border-b border-gray-200 dark:border-gray-600">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white">{{ $order->order_number }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <span class="px-4 py-2 rounded-full text-sm font-semibold
                            @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                            @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                            @elseif($order->status == 'completed') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                        
                        @if($order->payment)
                        <span class="px-4 py-2 rounded-full text-sm font-semibold
                            @if($order->payment->status == 'pending') bg-yellow-100 text-yellow-800
                            @elseif($order->payment->status == 'paid') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800
                            @endif">
                            Payment: {{ ucfirst($order->payment->status) }}
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="p-6">
                <div class="space-y-4 mb-4">
                    @foreach($order->orderItems as $item)
                    <div class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <!-- Image -->
                        <div class="w-20 h-20 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                            @if($item->orderable && $item->orderable->images && count($item->orderable->images) > 0)
                                <img src="{{ asset('storage/' . $item->orderable->images[0]) }}" 
                                     alt="{{ $item->product_name }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <i class="fas fa-image text-2xl"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Details -->
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-800 dark:text-white">{{ $item->product_name }}</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                {{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}
                            </p>
                        </div>

                        <!-- Subtotal -->
                        <div class="text-right">
                            <p class="font-bold text-gray-800 dark:text-white">
                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Order Total -->
                <div class="border-t border-gray-200 dark:border-gray-600 pt-4">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-lg font-semibold text-gray-800 dark:text-white">Total:</span>
                        <span class="text-2xl font-bold text-yellow-500">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </span>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-3">
                        <a href="{{ route('orders.show', $order) }}" 
                           class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white text-center px-4 py-3 rounded-lg transition">
                            <i class="fas fa-eye mr-2"></i>View Details
                        </a>
                        
                        @if($order->status == 'pending')
                        <form action="{{ route('orders.cancel', $order) }}" method="POST" class="flex-1">
                            @csrf
                            @method('PATCH')
                            <button type="submit" onclick="return confirm('Are you sure you want to cancel this order?')"
                                    class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-3 rounded-lg transition">
                                <i class="fas fa-times mr-2"></i>Cancel Order
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $orders->links() }}
    </div>
    @else
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-12 text-center">
        <i class="fas fa-shopping-cart text-6xl text-gray-300 dark:text-gray-600 mb-4"></i>
        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">No Orders Found</h3>
        <p class="text-gray-600 dark:text-gray-400 mb-6">You haven't placed any orders yet</p>
        <a href="{{ route('vehicles.index') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg inline-block transition">
            <i class="fas fa-shopping-cart mr-2"></i>Start Shopping
        </a>
    </div>
    @endif
</div>
@endsection
