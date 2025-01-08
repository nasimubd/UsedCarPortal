<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABC Cars Portal - Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom Styles -->
    <style>
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-indigo-700 via-purple-600 to-pink-500">
    <!-- Animated Background Shapes -->
    <div class="absolute inset-0 overflow-hidden opacity-20">
        <div class="absolute top-0 right-0 w-96 h-96 bg-purple-500 rounded-full mix-blend-multiply animate-blob"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 bg-pink-500 rounded-full mix-blend-multiply animate-blob"></div>
    </div>

    @include('layouts.navigation')

    <!-- Full Page Content Container -->
    <div class="bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-500 animate-gradient-x">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center text-white">
                <h1 class="text-5xl md:text-7xl font-bold mb-6 animate-fade-in-down">
                    Welcome to ABC Cars Portal
                    <span class="text-yellow-300">🚗</span>
                </h1>
                <p class="text-2xl mb-10 text-indigo-100">Your Premium Destination for Quality Used Cars</p>
                <div class="flex justify-center gap-6">
                    <a href="{{ route('cars.index') }}" class="transform hover:scale-105 transition bg-white text-purple-600 px-8 py-4 rounded-full font-bold shadow-lg hover:shadow-xl">
                        Browse Cars
                    </a>
                    @auth
                    @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="transform hover:scale-105 transition bg-indigo-800 text-white px-8 py-4 rounded-full font-bold shadow-lg hover:shadow-xl">
                        Admin Panel
                    </a>
                    @else
                    <a href="{{ route('cars.create') }}" class="transform hover:scale-105 transition bg-pink-600 text-white px-8 py-4 rounded-full font-bold shadow-lg hover:shadow-xl">
                        Sell Your Car
                    </a>
                    @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section with hover effects -->
    <div class="bg-gradient-to-b from-white to-indigo-50 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="transform hover:-translate-y-2 transition duration-300">
                    <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl border-b-4 border-purple-500">
                        <div class="text-5xl mb-6 text-purple-600">🚗</div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-800">Verified Sellers</h3>
                        <p class="text-gray-600">All our sellers undergo strict verification for your peace of mind</p>
                    </div>
                </div>
                <div class="transform hover:-translate-y-2 transition duration-300">
                    <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl border-b-4 border-pink-500">
                        <div class="text-5xl mb-6 text-pink-600">💰</div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-800">Best Deals</h3>
                        <p class="text-gray-600">Competitive prices with our innovative bidding system</p>
                    </div>
                </div>
                <div class="transform hover:-translate-y-2 transition duration-300">
                    <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl border-b-4 border-indigo-500">
                        <div class="text-5xl mb-6 text-indigo-600">✨</div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-800">Premium Quality</h3>
                        <p class="text-gray-600">Every vehicle passes our rigorous quality checks</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Listings with modern cards -->
    <div class="bg-gradient-to-b from-indigo-50 to-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-16 text-gray-800">Featured Listings</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach($featuredCars ?? [] as $car)
                <div class="transform hover:-translate-y-2 transition duration-300">
                    <div class="bg-white rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl">
                        <img src="{{ $car->image_url }}" alt="{{ $car->make }} {{ $car->model }}" class="w-full h-56 object-cover">
                        <div class="p-8">
                            <h3 class="text-2xl font-bold mb-3 text-gray-800">{{ $car->make }} {{ $car->model }}</h3>
                            <p class="text-3xl font-bold text-purple-600 mb-4">${{ number_format($car->price, 2) }}</p>
                            <a href="{{ route('cars.show', $car) }}" class="inline-block bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-3 rounded-full font-semibold hover:opacity-90 transition">
                                View Details →
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Call to Action with gradient -->
    <div class="bg-gradient-to-r from-purple-600 to-pink-600 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold mb-6 text-white">Ready to Find Your Dream Car?</h2>
            <p class="text-2xl mb-10 text-purple-100">Join thousands of satisfied customers today</p>
            @guest
            <div class="flex justify-center gap-6">
                <a href="{{ route('register') }}" class="transform hover:scale-105 transition bg-white text-purple-600 px-8 py-4 rounded-full font-bold shadow-lg hover:shadow-xl">
                    Get Started Now
                </a>
                <a href="{{ route('login') }}" class="transform hover:scale-105 transition border-2 border-white text-white px-8 py-4 rounded-full font-bold hover:bg-white hover:text-purple-600">
                    Sign In
                </a>
            </div>
            @endguest
        </div>
    </div>
</body>

</html>