@extends('layouts.app')

@section('title', 'Sales Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Sales Dashboard</h1>
        <p class="text-gray-600 dark:text-gray-400">Manage products and track sales</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- My Sales -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">My Sales</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $mySales }}</p>
                </div>
                <div class="bg-green-100 dark:bg-green-900 p-3 rounded-full">
                    <i class="fas fa-chart-line text-green-500 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Products -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Total Products</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $totalProducts }}</p>
                </div>
                <div class="bg-blue-100 dark:bg-blue-900 p-3 rounded-full">
                    <i class="fas fa-box text-blue-500 text-2xl"></i>
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
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <a href="{{ route('vehicles.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg p-8 text-center transition shadow-lg">
            <i class="fas fa-truck text-5xl mb-3"></i>
            <h3 class="text-xl font-bold">Tambah Kendaraan</h3>
            <p class="text-sm mt-2 opacity-90">Tambahkan kendaraan baru</p>
        </a>
        
        <a href="{{ route('spare-parts.create') }}" class="bg-green-500 hover:bg-green-600 text-white rounded-lg p-8 text-center transition shadow-lg">
            <i class="fas fa-cog text-5xl mb-3"></i>
            <h3 class="text-xl font-bold">Tambah Spare Part</h3>
            <p class="text-sm mt-2 opacity-90">Tambahkan spare part baru</p>
        </a>
        
        <a href="{{ route('orders.index') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg p-8 text-center transition shadow-lg">
            <i class="fas fa-list-check text-5xl mb-3"></i>
            <h3 class="text-xl font-bold">Kelola Orders</h3>
            <p class="text-sm mt-2 opacity-90">Lihat dan kelola pesanan</p>
        </a>
    </div>

    <!-- Recent Orders -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Recent Orders</h3>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Order ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($recentOrders as $order)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-white font-semibold">
                            {{ $order->order_number }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-400">
                            {{ $order->user->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-white">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold
                                @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                                @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                                @elseif($order->status == 'completed') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('orders.show', $order) }}" class="text-yellow-500 hover:text-yellow-600">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
