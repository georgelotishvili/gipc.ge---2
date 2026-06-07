<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div class="flex flex-col items-center space-y-3 sm:space-y-4">
                <a href="{{ route('index') }}" wire:navigate class="transition-all duration-300 hover:scale-105 hover:opacity-90">
                    <x-application-logo class="w-20 h-20 sm:w-24 sm:h-24" />
                </a>
                <div class="text-center px-2">
                    <h1 class="text-2xl sm:text-3xl font-display font-bold text-gray-900 dark:text-white tracking-tight">
                        {{ __('auth.Welcome back') }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-1 sm:mt-2 text-base sm:text-lg font-light">
                        {{ __('auth.Sign in to your account') }}
                    </p>
                </div>
            </div>
        </x-slot>

        <x-validation-errors class="mb-4 sm:mb-6" />

        @session('status')
            <div class="mb-4 sm:mb-6 p-3 sm:p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-md">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-600 dark:text-green-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-sm font-medium text-green-800 dark:text-green-200">
                        {{ $value }}
                    </span>
                </div>
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}" class="space-y-4 sm:space-y-6">
            @csrf

            <div class="space-y-2">
                <x-label for="email" value="{{ __('auth.Email') }}" class="text-sm font-semibold text-gray-700 dark:text-gray-300 tracking-wide" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                        </svg>
                    </div>
                    <x-input id="email" 
                             class="block w-full pl-10 pr-3 py-2.5 sm:py-3 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 text-sm sm:text-base" 
                             type="email" 
                             name="email" 
                             :value="old('email')" 
                             required 
                             autofocus 
                             autocomplete="username" 
                             placeholder="{{ __('auth.Enter your email') }}" />
                </div>
            </div>

            <div class="space-y-2">
                <x-label for="password" value="{{ __('auth.Password') }}" class="text-sm font-semibold text-gray-700 dark:text-gray-300 tracking-wide" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <x-input id="password" 
                             class="block w-full pl-10 pr-3 py-2.5 sm:py-3 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 text-sm sm:text-base" 
                             type="password" 
                             name="password" 
                             required 
                             autocomplete="current-password" 
                             placeholder="{{ __('auth.Enter your password') }}" />
                </div>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" class="rounded-md border-gray-300 dark:border-gray-600 text-blue-600 focus:ring-blue-500 dark:bg-gray-700" />
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400 font-medium">{{ __('auth.Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 font-semibold transition-colors duration-200" href="{{ route('password.request') }}">
                        {{ __('auth.Forgot password?') }}
                    </a>
                @endif
            </div>

            <div class="space-y-4">
                <x-button class="w-full justify-center py-2.5 sm:py-3 px-4 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:scale-[1.02] font-semibold text-sm sm:text-base">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    {{ __('auth.Sign in') }}
                </x-button>

                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400 font-medium">{{ __('auth.Or continue with') }}</span>
                    </div>
                </div>

                <div class="flex justify-center">
                    <button type="button" class="w-full max-w-xs inline-flex justify-center items-center py-2.5 sm:py-3 px-4 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-sm font-semibold text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 transition-all duration-200 hover:shadow-md">
                        <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        <span>{{ __('auth.Continue with Google') }}</span>
                    </button>
                </div>
            </div>

            <div class="text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">
                    {{ __("auth.Don't have an account?") }}
                    <a href="{{ route('register') }}" class="font-semibold text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 transition-colors duration-200">
                        {{ __('auth.Sign up') }}
                    </a>
                </p>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
