@extends('layouts.app')

@section('content')
<div class="relative bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
    <div class="absolute inset-0 bg-grid-slate-100 [mask-image:linear-gradient(0deg,#fff,rgba(255,255,255,0.6))]"></div>

    <div class="relative container mx-auto px-4 py-16 lg:py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Form Section -->
            <div class="bg-white shadow-2xl rounded-2xl p-8 lg:p-12 transform transition-all hover:scale-105 hover:shadow-3xl">
                <div class="text-center mb-10">
                    <h1 class="text-4xl font-extrabold text-gray-900 mb-4 tracking-tight">Get in Touch</h1>
                    <p class="text-xl text-gray-600">We're excited to hear from you!</p>
                </div>

                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                            <input type="text" name="first_name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition duration-300" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                            <input type="text" name="last_name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition duration-300" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input type="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition duration-300" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input type="tel" name="phone" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition duration-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Inquiry Type</label>
                        <select name="inquiry_type" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition duration-300">
                            <option value="general">General Inquiry</option>
                            <option value="sales">Sales Consultation</option>
                            <option value="support">Technical Support</option>
                            <option value="partnership">Partnership</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Your Message</label>
                        <textarea name="message" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition duration-300" required></textarea>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-lg hover:bg-blue-700 transition duration-300 transform hover:scale-105 shadow-lg">
                        Send Your Message
                    </button>
                </form>
            </div>

            <!-- Contact Information Section -->
            <div class="space-y-8">
                <!-- Contact Details Card -->
                <div class="bg-white rounded-2xl shadow-2xl p-8 transform transition-all hover:scale-105 hover:shadow-3xl">
                    <div class="flex items-center mb-6">
                        <svg class="w-12 h-12 text-blue-600 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <h3 class="text-2xl font-bold text-gray-900">Our Location</h3>
                    </div>
                    <p class="text-gray-600 text-lg">
                        123 Automotive Street<br>
                        Tech Hub, Singapore 123456
                    </p>
                </div>

                <!-- Contact Methods Card -->
                <div class="bg-white rounded-2xl shadow-2xl p-8 transform transition-all hover:scale-105 hover:shadow-3xl">
                    <div class="flex items-center mb-6">
                        <svg class="w-12 h-12 text-blue-600 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <h3 class="text-2xl font-bold text-gray-900">Contact Methods</h3>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-500">Phone</p>
                            <p class="text-lg font-semibold text-gray-900">+65 6789 0123</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="text-lg font-semibold text-gray-900">support@abccarsportal.com</p>
                        </div>
                    </div>
                </div>

                <!-- Business Hours Card -->
                <div class="bg-white rounded-2xl shadow-2xl p-8 transform transition-all hover:scale-105 hover:shadow-3xl">
                    <div class="flex items-center mb-6">
                        <svg class="w-12 h-12 text-blue-600 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="text-2xl font-bold text-gray-900">Business Hours</h3>
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Monday - Friday</span>
                            <span class="font-semibold">9:00 AM - 6:00 PM</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Saturday</span>
                            <span class="font-semibold">10:00 AM - 4:00 PM</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Sunday</span>
                            <span class="text-red-500">Closed</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection