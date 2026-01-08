@extends('layouts.app')

@section('title', 'Admin Dashboard')

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Admin Dashboard</h1>
        <p class="text-gray-600 dark:text-gray-400">Welcome back, {{ auth()->user()->name }}!</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Vehicles -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Total Kendaraan</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $totalVehicles }}</p>
                </div>
                <div class="bg-blue-100 dark:bg-blue-900 p-3 rounded-full">
                    <i class="fas fa-truck text-blue-500 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Spare Parts -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Total Spare Parts</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $totalSpareParts }}</p>
                </div>
                <div class="bg-green-100 dark:bg-green-900 p-3 rounded-full">
                    <i class="fas fa-cog text-green-500 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Total Orders</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $totalOrders }}</p>
                </div>
                <div class="bg-yellow-100 dark:bg-yellow-900 p-3 rounded-full">
                    <i class="fas fa-shopping-cart text-yellow-500 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Total Revenue</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-white">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                </div>
                <div class="bg-purple-100 dark:bg-purple-900 p-3 rounded-full">
                    <i class="fas fa-dollar-sign text-purple-500 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Sales Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Penjualan Bulanan</h3>
            <canvas id="salesChart"></canvas>
        </div>

        <!-- Orders by Status -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Order Status</h3>
            <canvas id="statusChart"></canvas>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-800 dark:text-white">Recent Orders</h3>
            <a href="{{ route('orders.index') }}" class="text-yellow-500 hover:text-yellow-600 font-semibold">
                View All <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Order ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Date</th>
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
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-400">
                            {{ $order->created_at->format('d M Y') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <a href="{{ route('vehicles.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg p-6 text-center transition">
            <i class="fas fa-plus-circle text-4xl mb-2"></i>
            <p class="font-semibold">Tambah Kendaraan</p>
        </a>
        
        <a href="{{ route('spare-parts.create') }}" class="bg-green-500 hover:bg-green-600 text-white rounded-lg p-6 text-center transition">
            <i class="fas fa-plus-circle text-4xl mb-2"></i>
            <p class="font-semibold">Tambah Spare Part</p>
        </a>
        
        <a href="{{ route('orders.index') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg p-6 text-center transition">
            <i class="fas fa-list text-4xl mb-2"></i>
            <p class="font-semibold">Kelola Orders</p>
        </a>
        
        <a href="{{ route('vehicles.export') }}" class="bg-purple-500 hover:bg-purple-600 text-white rounded-lg p-6 text-center transition">
            <i class="fas fa-download text-4xl mb-2"></i>
            <p class="font-semibold">Export Data</p>
        </a>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Sales Chart
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Sales',
                data: [12, 19, 15, 25, 22, 30, 28, 35, 32, 38, 42, 45],
                borderColor: 'rgb(234, 179, 8)',
                backgroundColor: 'rgba(234, 179, 8, 0.1)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Status Chart
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    const statusChart = new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Processing', 'Completed', 'Cancelled'],
            datasets: [{
                data: [{{ $ordersByStatus['pending'] ?? 0 }}, {{ $ordersByStatus['processing'] ?? 0 }}, {{ $ordersByStatus['completed'] ?? 0 }}, {{ $ordersByStatus['cancelled'] ?? 0 }}],
                backgroundColor: [
                    'rgb(234, 179, 8)',
                    'rgb(59, 130, 246)',
                    'rgb(34, 197, 94)',
                    'rgb(239, 68, 68)'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
@endpush
