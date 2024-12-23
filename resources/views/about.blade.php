@extends('layouts.app')

@section('content')
<div class="relative bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
    <div class="absolute inset-0 bg-grid-slate-100 [mask-image:linear-gradient(0deg,#fff,rgba(255,255,255,0.6))]"></div>

    <div class="relative container mx-auto px-4 py-16 lg:py-24">
        <!-- Hero Section -->
        <div class="text-center mb-20 space-y-6">
            <h1 class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">
                ABC Cars Portal
            </h1>
            <p class="text-xl text-gray-700 max-w-3xl mx-auto leading-relaxed">
                Revolutionizing the automotive marketplace with cutting-edge technology and unparalleled user experience
            </p>
        </div>

        <!-- Mission Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-20">
            <div class="space-y-6">
                <h2 class="text-3xl font-bold text-gray-900">Our Mission</h2>
                <p class="text-lg text-gray-600 leading-relaxed">
                    We're on a mission to transform how people discover, buy, and sell vehicles. By leveraging advanced technology and a user-centric approach, we create seamless automotive experiences that connect buyers and sellers effortlessly.
                </p>
                <div class="flex space-x-4">
                    <div class="bg-blue-100 p-4 rounded-lg">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="block mt-2 text-sm font-semibold text-gray-800">Transparent Listings</span>
                    </div>
                    <div class="bg-purple-100 p-4 rounded-lg">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        <span class="block mt-2 text-sm font-semibold text-gray-800">Advanced Technology</span>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="bg-white p-6 rounded-2xl shadow-2xl transform transition-all hover:scale-105">
                    <img src="{{ asset('images/mission-image.jpg') }}" alt="Our Mission" class="rounded-xl w-full h-auto object-cover">
                </div>
            </div>
        </div>

        <!-- Core Values Section -->
        <div class="py-16">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Our Core Values</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-lg text-center transform transition-all hover:scale-105">
                    <div class="w-16 h-16 mx-auto mb-4 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Customer First</h3>
                    <p class="text-gray-600">Putting our customers' needs and satisfaction at the heart of everything we do</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg text-center transform transition-all hover:scale-105">
                    <div class="w-16 h-16 mx-auto mb-4 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Integrity</h3>
                    <p class="text-gray-600">Maintaining the highest standards of honesty and transparency in all interactions</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg text-center transform transition-all hover:scale-105">
                    <div class="w-16 h-16 mx-auto mb-4 bg-purple-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Innovation</h3>
                    <p class="text-gray-600">Continuously evolving and embracing cutting-edge technologies</p>
                </div>
            </div>
        </div>

        <!-- Team Section -->
        <div class="py-16">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Our Leadership Team</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl shadow-lg p-6 text-center transform transition-all hover:scale-105">
                    <img class="w-32 h-32 rounded-full mx-auto mb-4 object-cover" src="{{ asset('images/team1.jpg') }}" alt="John Smith">
                    <h3 class="text-xl font-semibold text-gray-900">John Smith</h3>
                    <p class="text-gray-600">CEO & Founder</p>
                </div>
                <div class="bg-white rounded-2xl shadow-lg p-6 text-center transform transition-all hover:scale-105">
                    <img class="w-32 h-32 rounded-full mx-auto mb-4 object-cover" src="{{ asset('images/team2.jpg') }}" alt="Sarah Johnson">
                    <h3 class="text-xl font-semibold text-gray-900">Sarah Johnson</h3>
                    <p class="text-gray-600">Chief Operations Officer</p>
                </div>
                <div class="bg-white rounded-2xl shadow-lg p-6 text-center transform transition-all hover:scale-105">
                    <img class="w-32 h-32 rounded-full mx-auto mb-4 object-cover" src="{{ asset('images/team3.jpg') }}" alt="Michael Chen">
                    <h3 class="text-xl font-semibold text-gray-900">Michael Chen</h3>
                    <p class="text-gray-600">Chief Technology Officer</p>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center py-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Ready to Join Our Automotive Revolution?</h2>
            <p class="text-xl text-gray-600 mb-8">Discover a smarter way to buy and sell cars</p>
            <a href="{{ route('cars.index') }}" class="inline-flex items-center px-8 py-4 border border-transparent text-base font-medium rounded-md text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 transform hover:scale-105 transition duration-300 shadow-lg">
                Explore Car Listings
            </a>
        </div>
    </div>
</div>
@endsection