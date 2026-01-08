<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Vehicle;
use App\Models\SparePart;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // Order 1
        $order1 = Order::create([
            'user_id' => 4, // PT Tambang Jaya
            'order_number' => Order::generateOrderNumber(),
            'total_amount' => 2500450000,
            'status' => 'completed',
            'payment_status' => 'paid',
            'shipping_address' => 'Jl. Customer No. 3, Jakarta',
            'notes' => 'Urgent delivery required',
        ]);

        OrderItem::create([
            'order_id' => $order1->id,
            'orderable_type' => Vehicle::class,
            'orderable_id' => 1, // Komatsu PC400-8
            'quantity' => 1,
            'price' => 2500000000,
            'subtotal' => 2500000000,
        ]);

        OrderItem::create([
            'order_id' => $order1->id,
            'orderable_type' => SparePart::class,
            'orderable_id' => 12, // Engine Oil Filter
            'quantity' => 1,
            'price' => 450000,
            'subtotal' => 450000,
        ]);

        Payment::create([
            'order_id' => $order1->id,
            'payment_method' => 'transfer',
            'amount' => 2500450000,
            'transaction_id' => 'TRX-' . uniqid(),
            'status' => 'success',
            'paid_at' => now(),
        ]);

        // Order 2
        $order2 = Order::create([
            'user_id' => 5, // PT Anugrah Mining
            'order_number' => Order::generateOrderNumber(),
            'total_amount' => 850000000,
            'status' => 'processing',
            'payment_status' => 'paid',
            'shipping_address' => 'Jl. Industri No. 45, Balikpapan',
            'notes' => null,
        ]);

        OrderItem::create([
            'order_id' => $order2->id,
            'orderable_type' => Vehicle::class,
            'orderable_id' => 3, // Hino FM 350 JD
            'quantity' => 1,
            'price' => 850000000,
            'subtotal' => 850000000,
        ]);

        Payment::create([
            'order_id' => $order2->id,
            'payment_method' => 'midtrans',
            'amount' => 850000000,
            'transaction_id' => 'TRX-' . uniqid(),
            'status' => 'success',
            'paid_at' => now(),
        ]);

        // Order 3
        $order3 = Order::create([
            'user_id' => 6, // CV Karya Tambang
            'order_number' => Order::generateOrderNumber(),
            'total_amount' => 155000000,
            'status' => 'shipped',
            'payment_status' => 'paid',
            'shipping_address' => 'Jl. Tambang No. 12, Samarinda',
            'notes' => 'Please call before delivery',
        ]);

        OrderItem::create([
            'order_id' => $order3->id,
            'orderable_type' => SparePart::class,
            'orderable_id' => 3, // Main Hydraulic Pump
            'quantity' => 2,
            'price' => 75000000,
            'subtotal' => 150000000,
        ]);

        OrderItem::create([
            'order_id' => $order3->id,
            'orderable_type' => SparePart::class,
            'orderable_id' => 17, // Operator Seat
            'quantity' => 4,
            'price' => 12500000,
            'subtotal' => 5000000,
        ]);

        Payment::create([
            'order_id' => $order3->id,
            'payment_method' => 'transfer',
            'amount' => 155000000,
            'transaction_id' => 'TRX-' . uniqid(),
            'status' => 'success',
            'paid_at' => now(),
        ]);

        // Order 4
        $order4 = Order::create([
            'user_id' => 7, // PT Bumi Resources
            'order_number' => Order::generateOrderNumber(),
            'total_amount' => 2800000000,
            'status' => 'confirmed',
            'payment_status' => 'paid',
            'shipping_address' => 'Jl. Gatot Subroto No. 88, Jakarta',
            'notes' => null,
        ]);

        OrderItem::create([
            'order_id' => $order4->id,
            'orderable_type' => Vehicle::class,
            'orderable_id' => 2, // Caterpillar 336
            'quantity' => 1,
            'price' => 2800000000,
            'subtotal' => 2800000000,
        ]);

        Payment::create([
            'order_id' => $order4->id,
            'payment_method' => 'midtrans',
            'amount' => 2800000000,
            'transaction_id' => 'TRX-' . uniqid(),
            'status' => 'success',
            'paid_at' => now(),
        ]);

        // Order 5
        $order5 = Order::create([
            'user_id' => 8, // PT Mandiri Mining
            'order_number' => Order::generateOrderNumber(),
            'total_amount' => 1800000000,
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'shipping_address' => 'Jl. Ahmad Yani No. 56, Banjarmasin',
            'notes' => 'Need quotation first',
        ]);

        OrderItem::create([
            'order_id' => $order5->id,
            'orderable_type' => Vehicle::class,
            'orderable_id' => 5, // Komatsu D85EX-18
            'quantity' => 1,
            'price' => 1800000000,
            'subtotal' => 1800000000,
        ]);

        Payment::create([
            'order_id' => $order5->id,
            'payment_method' => 'transfer',
            'amount' => 1800000000,
            'status' => 'pending',
            'paid_at' => null,
        ]);

        // Order 6
        $order6 = Order::create([
            'user_id' => 9, // CV Mitra Sejahtera
            'order_number' => Order::generateOrderNumber(),
            'total_amount' => 218500000,
            'status' => 'completed',
            'payment_status' => 'paid',
            'shipping_address' => 'Jl. Diponegoro No. 23, Makassar',
            'notes' => null,
        ]);

        OrderItem::create([
            'order_id' => $order6->id,
            'orderable_type' => SparePart::class,
            'orderable_id' => 5, // Transmission Assembly
            'quantity' => 1,
            'price' => 125000000,
            'subtotal' => 125000000,
        ]);

        OrderItem::create([
            'order_id' => $order6->id,
            'orderable_type' => SparePart::class,
            'orderable_id' => 7, // Track Link Assembly
            'quantity' => 2,
            'price' => 35000000,
            'subtotal' => 70000000,
        ]);

        OrderItem::create([
            'order_id' => $order6->id,
            'orderable_type' => SparePart::class,
            'orderable_id' => 19, // Backup Camera System
            'quantity' => 4,
            'price' => 8500000,
            'subtotal' => 3500000,
        ]);

        Payment::create([
            'order_id' => $order6->id,
            'payment_method' => 'transfer',
            'amount' => 218500000,
            'transaction_id' => 'TRX-' . uniqid(),
            'status' => 'success',
            'paid_at' => now(),
        ]);

        // Order 7
        $order7 = Order::create([
            'user_id' => 10, // PT Energi Batubara
            'order_number' => Order::generateOrderNumber(),
            'total_amount' => 1450000000,
            'status' => 'completed',
            'payment_status' => 'paid',
            'shipping_address' => 'Jl. Sudirman No. 77, Pontianak',
            'notes' => 'Include training for operator',
        ]);

        OrderItem::create([
            'order_id' => $order7->id,
            'orderable_type' => Vehicle::class,
            'orderable_id' => 7, // Komatsu WA470-8
            'quantity' => 1,
            'price' => 1450000000,
            'subtotal' => 1450000000,
        ]);

        Payment::create([
            'order_id' => $order7->id,
            'payment_method' => 'midtrans',
            'amount' => 1450000000,
            'transaction_id' => 'TRX-' . uniqid(),
            'status' => 'success',
            'paid_at' => now(),
        ]);

        // Order 8
        $order8 = Order::create([
            'user_id' => 11, // PT Global Mining
            'order_number' => Order::generateOrderNumber(),
            'total_amount' => 390500000,
            'status' => 'processing',
            'payment_status' => 'paid',
            'shipping_address' => 'Jl. MH Thamrin No. 15, Jakarta',
            'notes' => null,
        ]);

        OrderItem::create([
            'order_id' => $order8->id,
            'orderable_type' => SparePart::class,
            'orderable_id' => 1, // Komatsu SAA6D140E-5 Engine
            'quantity' => 2,
            'price' => 185000000,
            'subtotal' => 370000000,
        ]);

        OrderItem::create([
            'order_id' => $order8->id,
            'orderable_type' => SparePart::class,
            'orderable_id' => 12, // Engine Oil Filter
            'quantity' => 10,
            'price' => 450000,
            'subtotal' => 4500000,
        ]);

        OrderItem::create([
            'order_id' => $order8->id,
            'orderable_type' => SparePart::class,
            'orderable_id' => 14, // Hydraulic Oil 10W
            'quantity' => 20,
            'price' => 850000,
            'subtotal' => 17000000,
        ]);

        Payment::create([
            'order_id' => $order8->id,
            'payment_method' => 'transfer',
            'amount' => 390500000,
            'transaction_id' => 'TRX-' . uniqid(),
            'status' => 'success',
            'paid_at' => now(),
        ]);

        // Order 9
        $order9 = Order::create([
            'user_id' => 12, // CV Berkah Tambang
            'order_number' => Order::generateOrderNumber(),
            'total_amount' => 3200000000,
            'status' => 'confirmed',
            'payment_status' => 'paid',
            'shipping_address' => 'Jl. Jendral Sudirman No. 99, Palembang',
            'notes' => 'Special financing arrangement',
        ]);

        OrderItem::create([
            'order_id' => $order9->id,
            'orderable_type' => Vehicle::class,
            'orderable_id' => 11, // Atlas Copco DML
            'quantity' => 1,
            'price' => 3200000000,
            'subtotal' => 3200000000,
        ]);

        Payment::create([
            'order_id' => $order9->id,
            'payment_method' => 'midtrans',
            'amount' => 3200000000,
            'transaction_id' => 'TRX-' . uniqid(),
            'status' => 'success',
            'paid_at' => now(),
        ]);

        // Order 10
        $order10 = Order::create([
            'user_id' => 13, // PT Nusantara Coal
            'order_number' => Order::generateOrderNumber(),
            'total_amount' => 920000000,
            'status' => 'shipped',
            'payment_status' => 'paid',
            'shipping_address' => 'Jl. Pahlawan No. 34, Pekanbaru',
            'notes' => null,
        ]);

        OrderItem::create([
            'order_id' => $order10->id,
            'orderable_type' => Vehicle::class,
            'orderable_id' => 14, // Volvo FM 460
            'quantity' => 1,
            'price' => 920000000,
            'subtotal' => 920000000,
        ]);

        Payment::create([
            'order_id' => $order10->id,
            'payment_method' => 'transfer',
            'amount' => 920000000,
            'transaction_id' => 'TRX-' . uniqid(),
            'status' => 'success',
            'paid_at' => now(),
        ]);

        // Additional orders (11-15)
        for ($i = 11; $i <= 15; $i++) {
            $order = Order::create([
                'user_id' => rand(4, 16),
                'order_number' => Order::generateOrderNumber(),
                'total_amount' => rand(10000000, 500000000),
                'status' => ['pending', 'confirmed', 'processing', 'completed'][ rand(0, 3)],
                'payment_status' => ['paid', 'unpaid'][rand(0, 1)],
                'shipping_address' => 'Jl. Test No. ' . $i . ', Jakarta',
                'notes' => null,
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'orderable_type' => SparePart::class,
                'orderable_id' => rand(1, 20),
                'quantity' => rand(1, 5),
                'price' => rand(1000000, 50000000),
                'subtotal' => $order->total_amount,
            ]);

            Payment::create([
                'order_id' => $order->id,
                'payment_method' => ['transfer', 'midtrans'][rand(0, 1)],
                'amount' => $order->total_amount,
                'transaction_id' => 'TRX-' . uniqid(),
                'status' => $order->payment_status === 'paid' ? 'success' : 'pending',
                'paid_at' => $order->payment_status === 'paid' ? now() : null,
            ]);
        }
    }
}
