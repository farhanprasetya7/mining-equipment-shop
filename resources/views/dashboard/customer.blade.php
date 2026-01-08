@extends('layouts.app')

@section('title', 'Customer Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Welcome, {{ auth()->user()->name }}!</h1>
        <p class="text-gray-600 dark:text-gray-400">Track your orders and browse products</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Orders -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Total Orders</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $totalOrders }}</p>
                </div>
                <div class="bg-blue-100 dark:bg-blue-900 p-3 rounded-full">
                    <i class="fas fa-shopping-cart text-blue-500 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Pending Orders</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $pendingOrders }}</p>
                </div>
                <div class="bg-yellow-100 dark:bg-yellow-900 p-3 rounded-full">
                    <i class="fas fa-clock text-yellow-500 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Completed Orders -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Completed Orders</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $completedOrders }}</p>
                </div>
                <div class="bg-green-100 dark:bg-green-900 p-3 rounded-full">
                    <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <a href="{{ route('vehicles.index') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-lg p-8 text-center transition shadow-lg">
            <i class="fas fa-truck-monster text-5xl mb-3"></i>
            <h3 class="text-2xl font-bold">Browse Vehicles</h3>
            <p class="text-sm mt-2 opacity-90">Lihat koleksi kendaraan alat berat</p>
        </a>
        
        <a href="{{ route('spare-parts.index') }}" class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white rounded-lg p-8 text-center transition shadow-lg">
            <i class="fas fa-cog text-5xl mb-3"></i>
            <h3 class="text-2xl font-bold">Browse Spare Parts</h3>
            <p class="text-sm mt-2 opacity-90">Temukan spare parts yang Anda butuhkan</p>
        </a>
    </div>

    <!-- Recent Orders -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-800 dark:text-white">Your Recent Orders</h3>
            <a href="{{ route('orders.history') }}" class="text-yellow-500 hover:text-yellow-600 font-semibold">
                View All <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        
        @if($recentOrders->count() > 0)
        <div class="space-y-4">
            @foreach($recentOrders as $order)
            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:shadow-md transition">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <p class="font-bold text-gray-800 dark:text-white">{{ $order->order_number }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                        @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                        @elseif($order->status == 'completed') bg-green-100 text-green-800
                        @else bg-red-100 text-red-800
                        @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
                
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->orderItems->count() }} items</p>
                        <p class="text-lg font-bold text-gray-800 dark:text-white">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                    </div>
                    <a href="{{ route('orders.show', $order) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition">
                        View Details
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <i class="fas fa-shopping-cart text-6xl text-gray-300 dark:text-gray-600 mb-4"></i>
            <p class="text-gray-600 dark:text-gray-400 mb-4">You haven't placed any orders yet</p>
            <a href="{{ route('vehicles.index') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg inline-block transition">
                Start Shopping
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
