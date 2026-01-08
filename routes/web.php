<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::post('/login', function (Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);
    
    if (auth()->attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }
    
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
})->name('login.post')->middleware('guest');

Route::get('/register', function () {
    return view('auth.register');
})->name('register')->middleware('guest');

Route::post('/register', function (Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'phone' => 'nullable|string|max:20',
        'company' => 'nullable|string|max:255',
        'password' => 'required|string|min:8|confirmed',
    ]);
    
    // Get customer role (default to role_id = 3 for customer)
    $customerRoleId = 3;
    try {
        $customerRole = \App\Models\Role::where('name', 'customer')->first();
        if ($customerRole) {
            $customerRoleId = $customerRole->id;
        }
    } catch (\Exception $e) {
        // If role table doesn't exist or error, use default
        $customerRoleId = 3;
    }
    
    $user = \App\Models\User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'] ?? null,
        'company' => $validated['company'] ?? null,
        'address' => null,
        'password' => bcrypt($validated['password']),
        'role_id' => $customerRoleId,
        'is_active' => true,
        'email_verified_at' => now(),
    ]);
    
    auth()->login($user);
    
    return redirect('/dashboard')->with('success', 'Registration successful!');
})->name('register.post')->middleware('guest');

Route::post('/logout', function (Illuminate\Http\Request $request) {
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('home');
})->name('logout');

// Public Product Routes
Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
Route::get('/vehicles/{vehicle}', [VehicleController::class, 'show'])->name('vehicles.show');

Route::get('/spare-parts', [SparePartController::class, 'index'])->name('spare-parts.index');
Route::get('/spare-parts/{sparePart}', [SparePartController::class, 'show'])->name('spare-parts.show');

// Protected Routes (Require Authentication)
Route::middleware(['auth'])->group(function () {
    
    // Dashboard Routes (Role-based)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Order Routes for Customers
    Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::patch('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    
    // Admin & Sales Routes
    Route::middleware(['role:admin,sales'])->group(function () {
        
        // Vehicle Management
        Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
        Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
        Route::get('/vehicles/{vehicle}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');
        Route::put('/vehicles/{vehicle}', [VehicleController::class, 'update'])->name('vehicles.update');
        Route::delete('/vehicles/{vehicle}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');
        
        // Spare Parts Management
        Route::get('/spare-parts/create', [SparePartController::class, 'create'])->name('spare-parts.create');
        Route::post('/spare-parts', [SparePartController::class, 'store'])->name('spare-parts.store');
        Route::get('/spare-parts/{sparePart}/edit', [SparePartController::class, 'edit'])->name('spare-parts.edit');
        Route::put('/spare-parts/{sparePart}', [SparePartController::class, 'update'])->name('spare-parts.update');
        Route::delete('/spare-parts/{sparePart}', [SparePartController::class, 'destroy'])->name('spare-parts.destroy');
        
        // Order Management
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
    });
    
    // Admin Only Routes
    Route::middleware(['role:admin'])->group(function () {
        
        // Export/Import
        Route::get('/vehicles/export/excel', [VehicleController::class, 'export'])->name('vehicles.export');
        Route::post('/vehicles/import/excel', [VehicleController::class, 'import'])->name('vehicles.import');
        
        // API Routes for Charts
        Route::get('/api/dashboard/sales-data', [DashboardController::class, 'getSalesData']);
        Route::get('/api/dashboard/orders-by-status', [DashboardController::class, 'getOrdersByStatus']);
    });
});

// Profile Routes (if using Laravel Breeze/Jetstream)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return view('profile.edit');
    })->name('profile.edit');
});
