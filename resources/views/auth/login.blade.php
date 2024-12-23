<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center px-4 py-8">
        <div class="bg-white shadow-2xl rounded-xl overflow-hidden w-full max-w-md">
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-6 text-center">
                <h2 class="text-3xl font-bold text-white">ABC Cars Portal</h2>
                <p class="text-white opacity-80 mt-2">Welcome Back</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="p-8 space-y-6">
                @csrf

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
                        autofocus
                        autocomplete="username"
                        placeholder="Enter your email" />
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
                        autocomplete="current-password"
                        placeholder="Enter your password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input
                            type="checkbox"
                            name="remember"
                            class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-800 transition duration-300 ease-in-out">
                        {{ __('Forgot password?') }}
                    </a>
                    @endif
                </div>

                <div class="flex flex-col space-y-4">
                    <x-primary-button class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 transition duration-300 ease-in-out transform hover:scale-105">
                        {{ __('Log in') }}
                    </x-primary-button>

                    <div class="text-center">
                        <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 text-sm transition duration-300 ease-in-out">
                            {{ __('Don\'t have an account? Register') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>