<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Vehicle;
use App\Models\SparePart;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of orders
     */
    public function index(Request $request)
    {
        $query = Order::with(['user', 'payment']);

        // For customers, show only their orders
        if (auth()->user()->isCustomer()) {
            $query->where('user_id', auth()->id());
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by payment status
        if ($request->has('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        // Filter by date range
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->dateRange($request->start_date, $request->end_date);
        }

        // Search by order number
        if ($request->has('search')) {
            $query->where('order_number', 'like', "%{$request->search}%");
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order
     */
    public function create()
    {
        // Show shopping cart / checkout page
        return view('orders.create');
    }

    /**
     * Store a newly created order
     */
    public function store(StoreOrderRequest $request)
    {
        try {
            DB::beginTransaction();

            $totalAmount = 0;
            $orderItems = [];

            // Calculate total and prepare order items
            foreach ($request->items as $item) {
                if ($item['type'] === 'vehicle') {
                    $product = Vehicle::findOrFail($item['id']);
                } else {
                    $product = SparePart::findOrFail($item['id']);
                }

                // Check stock
                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Stok {$product->name} tidak mencukupi");
                }

                $subtotal = $product->price * $item['quantity'];
                $totalAmount += $subtotal;

                $orderItems[] = [
                    'orderable_type' => $item['type'] === 'vehicle' ? Vehicle::class : SparePart::class,
                    'orderable_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'subtotal' => $subtotal,
                ];

                // Reduce stock
                $product->decrement('stock', $item['quantity']);
            }

            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => Order::generateOrderNumber(),
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'shipping_address' => $request->shipping_address,
                'notes' => $request->notes,
            ]);

            // Create order items
            foreach ($orderItems as $item) {
                $order->orderItems()->create($item);
            }

            // Create payment record
            $payment = Payment::create([
                'order_id' => $order->id,
                'payment_method' => $request->payment_method,
                'amount' => $totalAmount,
                'status' => 'pending',
            ]);

            DB::commit();

            // Redirect to payment page
            if ($request->payment_method === 'midtrans') {
                return redirect()->route('payment.midtrans', $order);
            }

            return redirect()
                ->route('orders.show', $order)
                ->with('success', 'Pesanan berhasil dibuat. Silakan lakukan pembayaran.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal membuat pesanan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified order
     */
    public function show(Order $order)
    {
        // Check authorization
        if (auth()->user()->isCustomer() && $order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action');
        }

        $order->load(['user', 'orderItems.orderable', 'payment']);

        return view('orders.show', compact('order'));
    }

    /**
     * Update order status (Admin/Sales only)
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,completed,cancelled',
        ]);

        try {
            $order->update(['status' => $request->status]);

            return redirect()
                ->back()
                ->with('success', 'Status pesanan berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal memperbarui status: ' . $e->getMessage());
        }
    }

    /**
     * Cancel order (Customer only, if status is pending)
     */
    public function cancel(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if ($order->status !== 'pending') {
            return redirect()
                ->back()
                ->with('error', 'Pesanan tidak dapat dibatalkan');
        }

        try {
            DB::beginTransaction();

            // Restore stock
            foreach ($order->orderItems as $item) {
                $item->orderable->increment('stock', $item->quantity);
            }

            $order->update(['status' => 'cancelled']);

            DB::commit();

            return redirect()
                ->route('orders.index')
                ->with('success', 'Pesanan berhasil dibatalkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Gagal membatalkan pesanan: ' . $e->getMessage());
        }
    }

    /**
     * Show transaction history
     */
    public function history(Request $request)
    {
        $query = Order::where('user_id', auth()->id())
            ->with(['orderItems.orderable', 'payment']);

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->dateRange($request->start_date, $request->end_date);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('orders.history', compact('orders'));
    }
}
