<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ABC Cars - Premium Car Marketplace</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-blue-600 to-blue-800 min-h-screen">
        <div class="absolute inset-0">
            <img src="{{ asset('images/hero-car.jpg') }}" class="w-full h-full object-cover opacity-20">
        </div>
        <!-- Navigation -->
        <div class="relative">
            <nav class="container mx-auto px-6 py-4">
                <div class="flex justify-between items-center">
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('dashboard') }}" class="flex items-center">
                            <svg class="w-10 h-10 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                            </svg>
                            <span class="text-white font-bold text-2xl">ABC Cars</span>
                        </a>
                    </div>

                    <!-- Mobile Menu Button -->
                    <div class="md:hidden">
                        <button id="mobile-menu-toggle" class="text-white focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Desktop Navigation -->
                    <div class="hidden md:flex space-x-6 items-center">
                        <a href="{{ route('cars.index') }}" class="text-white hover:text-blue-200">Car Listings</a>
                        <a href="{{ route('about') }}" class="text-white hover:text-blue-200">About Us</a>
                        <a href="{{ route('contact') }}" class="text-white hover:text-blue-200">Contact</a>

                        @if(Auth::check() && Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="text-white hover:text-blue-200">Admin Dashboard</a>
                        @endif

                        @if (Route::has('login'))
                        @auth
                        <a href="{{ url('/dashboard') }}" class="text-white hover:text-blue-200">Dashboard</a>
                        @else
                        <a href="{{ route('login') }}" class="text-white hover:text-blue-200">Login</a>
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-white text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50">Register</a>
                        @endif
                        @endauth
                        @endif
                    </div>
                </div>

                <!-- Mobile Menu -->
                <div id="mobile-menu" class="md:hidden fixed inset-0 bg-blue-900 z-50 transform translate-x-full transition-transform duration-300 ease-in-out">
                    <div class="flex justify-between items-center p-6">
                        <a href="{{ route('dashboard') }}" class="flex items-center">
                            <svg class="w-10 h-10 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                            </svg>
                            <span class="text-white font-bold text-2xl">ABC Cars</span>
                        </a>
                        <button id="mobile-menu-close" class="text-white focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="flex flex-col space-y-6 p-6">
                        <a href="{{ route('cars.index') }}" class="text-white text-xl hover:text-blue-200">Car Listings</a>
                        <a href="{{ route('about') }}" class="text-white text-xl hover:text-blue-200">About Us</a>
                        <a href="{{ route('contact') }}" class="text-white text-xl hover:text-blue-200">Contact</a>

                        @if(Auth::check() && Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="text-white text-xl hover:text-blue-200">Admin Dashboard</a>
                        @endif

                        @if (Route::has('login'))
                        @auth
                        <a href="{{ url('/dashboard') }}" class="text-white text-xl hover:text-blue-200">Dashboard</a>
                        @else
                        <a href="{{ route('login') }}" class="text-white text-xl hover:text-blue-200">Login</a>
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-white text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50 text-center">Register</a>
                        @endif
                        @endauth
                        @endif
                    </div>
                </div>
            </nav>
        </div>



        <!-- Hero Content -->
        <div class="relative min-h-screen">
            <!-- Hero Background Image -->
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('images/hero-car.jpg') }}" alt="Luxury Car" class="w-full h-full object-cover">
                <!-- Gradient Overlay -->
                <!-- <div class="absolute inset-0 bg-gradient-to-r from-blue-900/90 to-blue-800/80"></div> -->
            </div>

            <!-- Navigation stays the same -->

            <!-- Hero Content -->
            <div class="relative z-10 container mx-auto px-6 h-[calc(100vh-88px)] flex items-center justify-center">
                <div class="max-w-3xl text-center">
                    <h1 class="text-6xl font-bold text-white mb-6 drop-shadow-lg">Find Your Perfect Car</h1>
                    <p class="text-xl text-blue-100 mb-8">Discover the largest selection of premium cars. Buy, sell, or browse - all in one place.</p>
                    <a href="{{ route('cars.index') }}" class="inline-block bg-white text-blue-600 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-blue-50 transition duration-300">Browse Cars</a>
                </div>
            </div>
        </div>


    </div>

    <!-- Features Section -->
    <div class="py-24 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-16">Why Choose ABC Cars?</h2>
            <div class="grid md:grid-cols-3 gap-12">
                <div class="text-center">
                    <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Verified Sellers</h3>
                    <p class="text-gray-600">All our sellers are verified to ensure safe and legitimate transactions.</p>
                </div>
                <div class="text-center">
                    <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">24/7 Support</h3>
                    <p class="text-gray-600">Our dedicated team is always ready to help you with any questions.</p>
                </div>
                <div class="text-center">
                    <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Secure Payments</h3>
                    <p class="text-gray-600">Multiple secure payment options for your peace of mind.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Cars Section -->
    <div class="py-24 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-16">Featured Cars</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Featured Car Cards will be dynamically populated -->
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="bg-blue-600 py-16">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-white mb-8">Ready to Find Your Dream Car?</h2>
            <div class="space-x-4">
                <a href="{{ route('register') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50">Get Started</a>
                <a href="{{ route('cars.index') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700">Browse Cars</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">ABC Cars</h3>
                    <p class="text-gray-400">Your trusted partner in finding the perfect vehicle.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">About Us</a></li>
                        <li><a href="#" class="hover:text-white">Contact</a></li>
                        <li><a href="#" class="hover:text-white">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Contact Us</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>Email: info@abccars.com</li>
                        <li>Phone: (123) 456-7890</li>
                        <li>Address: 123 Car Street</li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="hover:text-blue-400"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="hover:text-blue-400"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="hover:text-blue-400"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} ABC Cars. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            const mobileMenuClose = document.getElementById('mobile-menu-close');
            const mobileMenu = document.getElementById('mobile-menu');

            mobileMenuToggle.addEventListener('click', function() {
                mobileMenu.classList.remove('translate-x-full');
                mobileMenu.classList.add('translate-x-0');
            });

            mobileMenuClose.addEventListener('click', function() {
                mobileMenu.classList.remove('translate-x-0');
                mobileMenu.classList.add('translate-x-full');
            });
        });
    </script>
</body>

</html>