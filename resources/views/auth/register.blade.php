<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div class="flex flex-col items-center space-y-3 sm:space-y-4">
                <a href="{{ route('index') }}" wire:navigate class="transition-all duration-300 hover:scale-105 hover:opacity-90">
                    <x-application-logo class="w-20 h-20 sm:w-24 sm:h-24" />
                </a>
                <div class="text-center px-2">
                    <h1 class="text-2xl sm:text-3xl font-display font-bold text-gray-900 dark:text-white tracking-tight">
                        {{ __('auth.Create account') }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-1 sm:mt-2 text-base sm:text-lg font-light">
                        {{ __('auth.Join us today') }}
                    </p>
                </div>
            </div>
        </x-slot>

        <x-validation-errors class="mb-4 sm:mb-6" />

        <form method="POST" action="{{ route('register') }}" class="space-y-4 sm:space-y-6">
            @csrf

            <div class="space-y-2">
                <x-label for="name" value="{{ __('auth.Name') }}" class="text-sm font-semibold text-gray-700 dark:text-gray-300 tracking-wide" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <x-input id="name" 
                             class="block w-full pl-10 pr-3 py-3 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                             type="text" 
                             name="name" 
                             :value="old('name')" 
                             required 
                             autofocus 
                             autocomplete="name" 
                             placeholder="{{ __('auth.Enter your name') }}" />
                </div>
            </div>

            <div class="space-y-2">
                <x-label for="email" value="{{ __('auth.Email') }}" class="text-sm font-semibold text-gray-700 dark:text-gray-300 tracking-wide" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                        </svg>
                    </div>
                    <x-input id="email" 
                             class="block w-full pl-10 pr-3 py-3 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                             type="email" 
                             name="email" 
                             :value="old('email')" 
                             required 
                             autocomplete="username" 
                             placeholder="{{ __('auth.Enter your email') }}" />
                </div>
            </div>

            <div class="space-y-2">
                <x-label for="password" value="{{ __('auth.Password') }}" class="text-sm font-semibold text-gray-700 dark:text-gray-300 tracking-wide" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <x-input id="password" 
                             class="block w-full pl-10 pr-3 py-3 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                             type="password" 
                             name="password" 
                             required 
                             autocomplete="new-password" 
                             placeholder="{{ __('auth.Enter your password') }}" />
                </div>
            </div>

            <div class="space-y-2">
                <x-label for="password_confirmation" value="{{ __('auth.Confirm password') }}" class="text-sm font-semibold text-gray-700 dark:text-gray-300 tracking-wide" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <x-input id="password_confirmation" 
                             class="block w-full pl-10 pr-3 py-3 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                             type="password" 
                             name="password_confirmation" 
                             required 
                             autocomplete="new-password" 
                             placeholder="{{ __('auth.Confirm your password') }}" />
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex items-start">
                    <x-checkbox name="terms" 
                               id="terms" 
                               required 
                               class="h-5 w-5 mt-1 border-gray-300 dark:border-gray-600 text-blue-600 focus:ring-blue-500 dark:bg-gray-700" />
                    <label for="terms" class="ml-3 text-sm text-gray-600 dark:text-gray-400 font-medium">
                        {{ __('auth.I agree to the') }}
                        <a href="{{ route('terms-and-conditions') }}" class="font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 transition-colors duration-200">
                            {{ __('auth.terms and conditions') }}
                        </a>
                        {{ __('auth.and') }}
                        <a href="{{ route('privacy-policy') }}" class="font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 transition-colors duration-200">
                            {{ __('auth.privacy policy') }}
                        </a>
                    </label>
                </div>

                <x-button class="w-full justify-center py-2.5 sm:py-3 px-4 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:scale-[1.02] font-semibold text-sm sm:text-base">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    {{ __('auth.Sign up') }}
                </x-button>
            </div>

            <div class="text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">
                    {{ __('auth.Already have an account?') }}
                    <a href="{{ route('login') }}" class="font-semibold text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 transition-colors duration-200">
                        {{ __('auth.Sign in') }}
                    </a>
                </p>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
