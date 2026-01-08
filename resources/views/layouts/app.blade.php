<!DOCTYPE html>
<html lang="id" x-data="{ darkMode: false }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Mining Equipment Shop')</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#eab308',
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine.js for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    @stack('styles')
</head>
<body class="bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    
    <!-- Navigation -->
    <nav class="bg-white dark:bg-gray-800 shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo & Brand -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <i class="fas fa-truck-monster text-3xl text-yellow-500"></i>
                        <span class="ml-2 text-xl font-bold text-gray-800 dark:text-white">Mining Equipment</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-gray-700 dark:text-gray-300 hover:text-yellow-500 transition">
                        <i class="fas fa-home mr-1"></i> Home
                    </a>
                    <a href="{{ route('vehicles.index') }}" class="text-gray-700 dark:text-gray-300 hover:text-yellow-500 transition">
                        <i class="fas fa-truck mr-1"></i> Vehicles
                    </a>
                    <a href="{{ route('spare-parts.index') }}" class="text-gray-700 dark:text-gray-300 hover:text-yellow-500 transition">
                        <i class="fas fa-cog mr-1"></i> Spare Parts
                    </a>
                    
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 dark:text-gray-300 hover:text-yellow-500 transition">
                            <i class="fas fa-dashboard mr-1"></i> Dashboard
                        </a>
                        @if(auth()->user()->isCustomer())
                        <a href="{{ route('orders.history') }}" class="text-gray-700 dark:text-gray-300 hover:text-yellow-500 transition">
                            <i class="fas fa-history mr-1"></i> Orders
                        </a>
                        @endif
                    @endauth

                    <!-- Dark Mode Toggle -->
                    <button @click="darkMode = !darkMode" class="text-gray-700 dark:text-gray-300 hover:text-yellow-500 transition">
                        <i class="fas fa-moon" x-show="!darkMode"></i>
                        <i class="fas fa-sun" x-show="darkMode" style="display: none;"></i>
                    </button>

                    <!-- Auth Links -->
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-yellow-500 transition">
                            <i class="fas fa-sign-in-alt mr-1"></i> Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition">
                            Register
                        </a>
                    @else
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center text-gray-700 dark:text-gray-300 hover:text-yellow-500">
                                <img src="{{ auth()->user()->profile_photo ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}" 
                                     class="w-8 h-8 rounded-full mr-2">
                                <span>{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down ml-1 text-xs"></i>
                            </button>
                            
                            <div x-show="open" @click.away="open = false" 
                                 class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 rounded-lg shadow-xl py-2"
                                 style="display: none;">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <i class="fas fa-user mr-2"></i> Profile
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenu = !mobileMenu" class="text-gray-700 dark:text-gray-300">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenu" class="md:hidden" style="display: none;" x-data="{ mobileMenu: false }">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-white dark:bg-gray-800">
                <a href="{{ route('home') }}" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded">
                    Home
                </a>
                <a href="{{ route('vehicles.index') }}" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded">
                    Vehicles
                </a>
                <a href="{{ route('spare-parts.index') }}" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded">
                    Spare Parts
                </a>
                @auth
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded">
                        Dashboard
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
         class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            <span class="block sm:inline">{{ session('success') }}</span>
            <button @click="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
         class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
            <span class="block sm:inline">{{ session('error') }}</span>
            <button @click="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    @endif

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Mining Equipment Shop</h3>
                    <p class="text-gray-400">Penyedia kendaraan alat berat dan spare parts terlengkap untuk kebutuhan pertambangan Anda.</p>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('vehicles.index') }}" class="text-gray-400 hover:text-yellow-500">Vehicles</a></li>
                        <li><a href="{{ route('spare-parts.index') }}" class="text-gray-400 hover:text-yellow-500">Spare Parts</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-500">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-500">Contact</a></li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><i class="fas fa-phone mr-2"></i> +62 812-3456-7890</li>
                        <li><i class="fas fa-envelope mr-2"></i> info@miningequip.com</li>
                        <li><i class="fas fa-map-marker-alt mr-2"></i> Jakarta, Indonesia</li>
                    </ul>
                </div>
                
                <!-- Social Media -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-yellow-500 text-2xl"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-gray-400 hover:text-yellow-500 text-2xl"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-yellow-500 text-2xl"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-yellow-500 text-2xl"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Mining Equipment Shop. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
