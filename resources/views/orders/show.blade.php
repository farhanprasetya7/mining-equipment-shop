@extends('layouts.app')

@section('title', 'Order Details - ' . $order->order_number)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('orders.history') }}" class="text-yellow-500 hover:text-yellow-600 mb-4 inline-block">
            <i class="fas fa-arrow-left mr-2"></i>Back to Orders
        </a>
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Order Details</h1>
        <p class="text-gray-600 dark:text-gray-400">{{ $order->order_number }}</p>
    </div>

    <!-- Order Status -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-1">Order Date</p>
                <p class="text-lg font-semibold text-gray-800 dark:text-white">
                    {{ $order->created_at->format('d M Y, H:i') }}
                </p>
            </div>

            <div>
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-1">Order Status</p>
                <span class="px-4 py-2 rounded-full text-sm font-semibold inline-block
                    @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                    @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                    @elseif($order->status == 'completed') bg-green-100 text-green-800
                    @else bg-red-100 text-red-800
                    @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            @if($order->payment)
            <div>
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-1">Payment Status</p>
                <span class="px-4 py-2 rounded-full text-sm font-semibold inline-block
                    @if($order->payment->status == 'pending') bg-yellow-100 text-yellow-800
                    @elseif($order->payment->status == 'paid') bg-green-100 text-green-800
                    @else bg-red-100 text-red-800
                    @endif">
                    {{ ucfirst($order->payment->status) }}
                </span>
            </div>
            @endif
        </div>
    </div>

    <!-- Customer Info -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Customer Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Name</p>
                <p class="font-semibold text-gray-800 dark:text-white">{{ $order->user->name }}</p>
            </div>
            <div>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Email</p>
                <p class="font-semibold text-gray-800 dark:text-white">{{ $order->user->email }}</p>
            </div>
            @if($order->user->phone)
            <div>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Phone</p>
                <p class="font-semibold text-gray-800 dark:text-white">{{ $order->user->phone }}</p>
            </div>
            @endif
            @if($order->user->company)
            <div>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Company</p>
                <p class="font-semibold text-gray-800 dark:text-white">{{ $order->user->company }}</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Order Items -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Order Items</h2>
        
        <div class="space-y-4">
            @foreach($order->orderItems as $item)
            <div class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                <!-- Image -->
                <div class="w-24 h-24 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                    @if($item->orderable && $item->orderable->images && count($item->orderable->images) > 0)
                        <img src="{{ asset('storage/' . $item->orderable->images[0]) }}" 
                             alt="{{ $item->product_name }}" 
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <i class="fas fa-image text-3xl"></i>
                        </div>
                    @endif
                </div>

                <!-- Details -->
                <div class="flex-1">
                    <h4 class="font-bold text-gray-800 dark:text-white text-lg">{{ $item->product_name }}</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                        Type: {{ class_basename($item->orderable_type) }}
                    </p>
                    <div class="flex items-center gap-4">
                        <p class="text-gray-600 dark:text-gray-400">
                            Qty: <strong>{{ $item->quantity }}</strong>
                        </p>
                        <p class="text-gray-600 dark:text-gray-400">
                            Price: <strong>Rp {{ number_format($item->price, 0, ',', '.') }}</strong>
                        </p>
                    </div>
                </div>

                <!-- Subtotal -->
                <div class="text-right">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Subtotal</p>
                    <p class="text-xl font-bold text-gray-800 dark:text-white">
                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Order Summary -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Order Summary</h2>
        
        <div class="space-y-3">
            <div class="flex justify-between">
                <span class="text-gray-600 dark:text-gray-400">Subtotal</span>
                <span class="font-semibold text-gray-800 dark:text-white">
                    Rp {{ number_format($order->orderItems->sum('subtotal'), 0, ',', '.') }}
                </span>
            </div>
            
            @if($order->notes)
            <div class="pt-3 border-t border-gray-200 dark:border-gray-600">
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-1">Notes</p>
                <p class="text-gray-800 dark:text-white">{{ $order->notes }}</p>
            </div>
            @endif
            
            <div class="pt-3 border-t-2 border-gray-300 dark:border-gray-600 flex justify-between items-center">
                <span class="text-xl font-bold text-gray-800 dark:text-white">Total</span>
                <span class="text-3xl font-bold text-yellow-500">
                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                </span>
            </div>
        </div>
    </div>

    <!-- Payment Info -->
    @if($order->payment)
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Payment Information</h2>
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Payment Method</p>
                <p class="font-semibold text-gray-800 dark:text-white">{{ ucfirst($order->payment->payment_method) }}</p>
            </div>
            <div>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Payment Status</p>
                <span class="px-3 py-1 rounded-full text-sm font-semibold inline-block
                    @if($order->payment->status == 'pending') bg-yellow-100 text-yellow-800
                    @elseif($order->payment->status == 'paid') bg-green-100 text-green-800
                    @else bg-red-100 text-red-800
                    @endif">
                    {{ ucfirst($order->payment->status) }}
                </span>
            </div>
            @if($order->payment->paid_at)
            <div>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Paid At</p>
                <p class="font-semibold text-gray-800 dark:text-white">
                    {{ $order->payment->paid_at->format('d M Y, H:i') }}
                </p>
            </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Actions -->
    <div class="flex gap-3">
        @if(auth()->user()->isAdmin() || auth()->user()->isSales())
        <form action="{{ route('orders.update-status', $order) }}" method="POST" class="flex-1">
            @csrf
            @method('PATCH')
            <select name="status" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg mb-3 dark:bg-gray-700 dark:text-white">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-3 rounded-lg transition">
                <i class="fas fa-save mr-2"></i>Update Status
            </button>
        </form>
        @endif

        @if(auth()->user()->isCustomer() && $order->status == 'pending')
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
@endsection
