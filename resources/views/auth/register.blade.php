<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
        <div class="bg-white shadow-2xl rounded-xl overflow-hidden w-full max-w-md">
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-6 text-center">
                <h2 class="text-3xl font-bold text-white">ABC Cars Portal</h2>
                <p class="text-white opacity-80 mt-2">Create Your Account</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="p-8 space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Full Name')" class="text-gray-700 font-semibold" />
                    <x-text-input
                        id="name"
                        class="mt-2 w-full border-2 border-gray-300 focus:border-blue-500 rounded-lg transition duration-300 ease-in-out"
                        type="text"
                        name="name"
                        :value="old('name')"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="Enter your full name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500" />
                </div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 font-semibold" />
                    <x-text-input
                        id="email"
                        class="mt-2 w-full border-2 border-gray-300 focus:border-blue-500 rounded-lg transition duration-300 ease-in-out"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autocomplete="username"
                        placeholder="you@example.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-semibold" />
                    <x-text-input
                        id="password"
                        class="mt-2 w-full border-2 border-gray-300 focus:border-blue-500 rounded-lg transition duration-300 ease-in-out"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="Create a strong password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 font-semibold" />
                    <x-text-input
                        id="password_confirmation"
                        class="mt-2 w-full border-2 border-gray-300 focus:border-blue-500 rounded-lg transition duration-300 ease-in-out"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="Confirm your password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500" />
                </div>

                <div class="flex flex-col space-y-4">
                    <x-primary-button class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 transition duration-300 ease-in-out transform hover:scale-105">
                        {{ __('Create Account') }}
                    </x-primary-button>

                    <div class="text-center">
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 text-sm transition duration-300 ease-in-out">
                            {{ __('Already have an account? Login') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>