<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Vehicle;
use App\Models\SparePart;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show the dashboard based on user role
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return $this->adminDashboard();
        } elseif ($user->isSales()) {
            return $this->salesDashboard();
        } else {
            return $this->customerDashboard();
        }
    }

    /**
     * Admin Dashboard with full statistics
     */
    private function adminDashboard()
    {
        // Overall Statistics
        $totalRevenue = Payment::where('status', 'success')->sum('amount');
        $totalOrders = Order::count();
        $totalVehicles = Vehicle::count();
        $totalSpareParts = SparePart::count();
        $totalCustomers = User::where('role_id', 3)->count();

        // Orders by Status
        $ordersByStatus = Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Recent Orders
        $recentOrders = Order::with(['user', 'payment'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Low Stock Vehicles
        $lowStockVehicles = Vehicle::where('stock', '<=', 2)
            ->orderBy('stock', 'asc')
            ->limit(10)
            ->get();

        // Low Stock Spare Parts
        $lowStockSpareParts = SparePart::where('stock', '<=', 5)
            ->orderBy('stock', 'asc')
            ->limit(10)
            ->get();

        // Monthly Revenue (Last 6 months)
        $monthlyRevenue = Payment::where('status', 'success')
            ->where('paid_at', '>=', now()->subMonths(6))
            ->select(
                DB::raw('MONTH(paid_at) as month'),
                DB::raw('YEAR(paid_at) as year'),
                DB::raw('SUM(amount) as total')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Top Selling Products
        $topVehicles = Vehicle::withCount('orderItems')
            ->orderBy('order_items_count', 'desc')
            ->limit(5)
            ->get();

        $topSpareParts = SparePart::withCount('orderItems')
            ->orderBy('order_items_count', 'desc')
            ->limit(5)
            ->get();

        // Sales by Category
        $salesByCategory = DB::table('categories')
            ->leftJoin('vehicles', 'categories.id', '=', 'vehicles.category_id')
            ->leftJoin('order_items', function($join) {
                $join->on('vehicles.id', '=', 'order_items.orderable_id')
                     ->where('order_items.orderable_type', '=', Vehicle::class);
            })
            ->select('categories.name', DB::raw('SUM(order_items.subtotal) as total'))
            ->groupBy('categories.id', 'categories.name')
            ->orderBy('total', 'desc')
            ->get();

        return view('dashboard.admin', compact(
            'totalRevenue',
            'totalOrders',
            'totalVehicles',
            'totalSpareParts',
            'totalCustomers',
            'ordersByStatus',
            'recentOrders',
            'lowStockVehicles',
            'lowStockSpareParts',
            'monthlyRevenue',
            'topVehicles',
            'topSpareParts',
            'salesByCategory'
        ));
    }

    /**
     * Sales Dashboard with limited statistics
     */
    private function salesDashboard()
    {
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalVehicles = Vehicle::count();
        $totalSpareParts = SparePart::count();

        $recentOrders = Order::with(['user', 'payment'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $lowStockVehicles = Vehicle::where('stock', '<=', 2)
            ->orderBy('stock', 'asc')
            ->limit(5)
            ->get();

        $lowStockSpareParts = SparePart::where('stock', '<=', 5)
            ->orderBy('stock', 'asc')
            ->limit(5)
            ->get();

        return view('dashboard.sales', compact(
            'totalOrders',
            'pendingOrders',
            'totalVehicles',
            'totalSpareParts',
            'recentOrders',
            'lowStockVehicles',
            'lowStockSpareParts'
        ));
    }

    /**
     * Customer Dashboard
     */
    private function customerDashboard()
    {
        $user = auth()->user();

        $totalOrders = Order::where('user_id', $user->id)->count();
        $pendingOrders = Order::where('user_id', $user->id)
            ->where('status', 'pending')
            ->count();
        $completedOrders = Order::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();

        $recentOrders = Order::where('user_id', $user->id)
            ->with(['orderItems.orderable', 'payment'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $featuredVehicles = Vehicle::where('is_featured', true)
            ->limit(4)
            ->get();

        return view('dashboard.customer', compact(
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'recentOrders',
            'featuredVehicles'
        ));
    }

    /**
     * Get chart data for admin dashboard (AJAX)
     */
    public function getChartData(Request $request)
    {
        $type = $request->get('type', 'revenue');

        switch ($type) {
            case 'revenue':
                return $this->getRevenueChartData();
            case 'orders':
                return $this->getOrdersChartData();
            case 'categories':
                return $this->getCategoriesChartData();
            default:
                return response()->json(['error' => 'Invalid chart type'], 400);
        }
    }

    private function getRevenueChartData()
    {
        $data = Payment::where('status', 'success')
            ->where('paid_at', '>=', now()->subMonths(12))
            ->select(
                DB::raw('DATE_FORMAT(paid_at, "%Y-%m") as month'),
                DB::raw('SUM(amount) as total')
            )
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        return response()->json([
            'labels' => $data->pluck('month'),
            'values' => $data->pluck('total'),
        ]);
    }

    private function getOrdersChartData()
    {
        $data = Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        return response()->json([
            'labels' => $data->pluck('status'),
            'values' => $data->pluck('count'),
        ]);
    }

    private function getCategoriesChartData()
    {
        $data = DB::table('categories')
            ->leftJoin('vehicles', 'categories.id', '=', 'vehicles.category_id')
            ->select('categories.name', DB::raw('COUNT(vehicles.id) as count'))
            ->groupBy('categories.id', 'categories.name')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();

        return response()->json([
            'labels' => $data->pluck('name'),
            'values' => $data->pluck('count'),
        ]);
    }
}
