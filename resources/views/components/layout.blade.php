<!doctype html>
<html lang="en" style="font-family: 'DejaVu Sans Condensed', sans-serif;" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="color-scheme" content="light dark">
    
    <!-- Dark mode initialization -->
    <script>
        // Immediately apply dark mode if saved
        if (localStorage.getItem('darkMode') === 'true') {
            document.documentElement.classList.add('dark');
            document.body.style.backgroundColor = '#0F172A';
            document.body.style.color = '#ffffff';
        }
    </script>
    
    <link rel="stylesheet" href="/node_modules/dejavu-sans-condensed/css/dejavu-sans-condensed.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>GIPC</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @livewireStyles()
    
    <style>
        /* Dark mode styles */
        .dark-mode {
            background-color: #0F172A !important;
            color: #ffffff !important;
        }
        
        .dark-mode .bg-white {
            background-color: #0F172A !important;
        }
        
        .dark-mode .text-gray-600 {
            color: #9CA3AF !important;
        }
        
        .dark-mode .text-gray-300 {
            color: #D1D5DB !important;
        }
        
        .dark-mode .border-gray-100 {
            border-color: #1F2A37 !important;
        }
        
        .dark-mode .border-gray-800 {
            border-color: #374151 !important;
        }
        
        .dark-mode .bg-white\/80 {
            background-color: rgba(15, 23, 42, 0.8) !important;
        }
        
        .dark-mode .dark\:bg-dark {
            background-color: #0F172A !important;
        }
        
        .dark-mode .dark\:text-white {
            color: #ffffff !important;
        }
        
        .dark-mode .dark\:text-gray-300 {
            color: #D1D5DB !important;
        }
        
        .dark-mode .dark\:border-gray-800 {
            border-color: #374151 !important;
        }
        
        .dark-mode .dark\:bg-dark-2 {
            background-color: #1F2A37 !important;
        }
        
        .dark-mode .dark\:text-dark-6 {
            color: #9CA3AF !important;
        }
        
        .dark-mode .dark\:border-dark-4 {
            border-color: #4B5563 !important;
        }
        
        .dark-mode .dark\:hover\:bg-dark-4:hover {
            background-color: #4B5563 !important;
        }
        
        .dark-mode .dark\:hover\:text-primary-400:hover {
            color: #60A5FA !important;
        }
        
        .dark-mode .dark\:hover\:text-primary-600:hover {
            color: #2563EB !important;
        }
        
        /* Icon colors for better visibility */
        .darkswitcher svg {
            color: #374151 !important; /* Darker gray for better visibility in light mode */
        }
        
        .dark-mode .darkswitcher svg {
            color: #D1D5DB !important; /* Light gray for dark mode */
        }
        
        /* Ensure icons are visible */
        .darkswitcher svg {
            display: block !important;
        }
        
        .darkswitcher .hidden {
            display: none !important;
        }
    </style>
</head>

<body class="bg-white dark:bg-dark" id="body">
    <!-- ====== Navbar Section Start -->
    <nav class="fixed w-full bg-white/80 dark:bg-dark top-0 z-50 border-b border-gray-100 dark:border-gray-800">
        <div class="max-w-[120rem] mx-auto px-6 sm:px-8 lg:px-12">
            <div class="flex justify-between h-20 items-center relative">
                <div class="flex-shrink-0 z-10">
                    <a href="/" wire:navigate class="flex items-center space-x-2 text-2xl font-bold text-primary-600 dark:text-primary-400">
                        <x-application-logo />
                    </a>
                </div>

                <!-- Centered Navigation Links -->
                <div class="hidden lg:flex absolute left-1/2 transform -translate-x-1/2 items-center space-x-8">
                    <a href="/" wire:navigate class="text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium">
                        მთავარი
                    </a>
                    <a href="/services" wire:navigate class="text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium">
                        სერვისები
                    </a>
                    <a href="/pricing" wire:navigate class="text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium">
                        ფასები
                    </a>
                    <a href="/about" wire:navigate class="text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium">
                        ჩვენს შესახებ
                    </a>
                </div>

                <!-- Right Side Actions -->
                <div class="flex items-center gap-2 sm:gap-3 2xsm:gap-7 z-10">
                    @auth
                        <!-- Desktop Notifications and Dark Mode (xl and up) -->
                        <ul class="hidden xl:flex items-center gap-2 2xsm:gap-4">
                            <!-- Theme Toggle -->
                            @if (auth()->user()->is_admin)
                                <li>
                                    <a href="/admin" wire:navigate class="flex h-9 items-center justify-center rounded-xl border-[0.5px] border-gray-300 dark:border-dark-4 px-4 hover:bg-gray-100 dark:hover:bg-dark-4 text-gray-700 dark:text-dark-6 bg-white dark:bg-dark-2 transition-all duration-200">
                                        ადმინ პანელი
                                    </a>
                                </li>
                            @endif
                            <li>
                                <button onclick="toggleDarkMode()" class="darkswitcher flex h-9 w-9 items-center justify-center rounded-xl border-[0.5px] border-gray-300 dark:border-dark-4 hover:bg-gray-100 dark:hover:bg-dark-4 bg-white dark:bg-dark-2 text-gray-700 dark:text-dark-6 transition-all duration-200">
                                    <svg id="sun" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707"/>
                                    </svg>
                                    <svg id="moon" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                                    </svg>
                                </button>
                            </li>

                            <!-- Notifications -->
                            <li>
                                <button class="relative flex h-9 w-9 items-center justify-center rounded-xl border-[0.5px] border-gray-300 dark:border-dark-4 hover:bg-gray-100 dark:hover:bg-dark-4 bg-white dark:bg-dark-2 text-gray-700 dark:text-dark-6 transition-all duration-200">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                    </svg>
                                    <span class="absolute -right-0.5 -top-0.5 flex h-4 w-4 items-center justify-center rounded-full bg-red-600 text-[8px] font-medium text-white">
                                        4
                                    </span>
                                </button>
                            </li>
                        </ul>

                        <!-- User Menu -->
                        <div x-data="{ dropdownOpen: false }" class="relative hidden lg:flex">
                            <button @click="dropdownOpen = !dropdownOpen" 
                                    class="flex items-center gap-2 sm:gap-4">
                                <span class="h-9 w-9 sm:h-10 sm:w-10 rounded-xl">
                                    <img src="{{ auth()->user()->profile_photo_url }}"
                                         alt="{{ auth()->user()->name }}"
                                         class="rounded-xl object-cover object-center">
                                </span>
                                <span class="hidden text-right xl:block">
                                    <span class="block text-sm font-medium text-black dark:text-white">{{ auth()->user()->name }}</span>
                                    <span class="block text-xs text-gray-500 dark:text-dark-6">{{ auth()->user()->role }}</span>
                                </span>
                                <svg :class="dropdownOpen && 'rotate-180'" class="hidden fill-current sm:block" width="12" height="8" viewBox="0 0 12 8">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.410765 0.910734C0.736202 0.585297 1.26384 0.585297 1.58928 0.910734L6.00002 5.32148L10.4108 0.910734C10.7362 0.585297 11.2638 0.585297 11.5893 0.910734C11.9147 1.23617 11.9147 1.76381 11.5893 2.08924L6.58928 7.08924C6.26384 7.41468 5.7362 7.41468 5.41077 7.08924L0.410765 2.08924C0.0853277 1.76381 0.0853277 1.23617 0.410765 0.910734Z"/>
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="dropdownOpen"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-100"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 @click.outside="dropdownOpen = false"
                                 class="absolute right-0 mt-4 flex w-62.5 flex-col rounded-xl border border-gray-200/50 bg-white shadow-lg dark:border-dark-4 dark:bg-dark-2">
                                <ul class="flex flex-col gap-4 px-6 py-5 dark:border-dark-4">
                                    <!-- Mobile/Tablet Notifications and Dark Mode (md to xl) -->
                                    <div class="flex items-center justify-between gap-4 xl:hidden pb-4 border-b border-gray-200/50 dark:border-dark-4">
                                        <button onclick="toggleDarkMode()" class="flex h-9 w-9 items-center justify-center rounded-xl border-[0.5px] border-gray-300 dark:border-dark-4 hover:bg-gray-100 dark:hover:bg-dark-4 bg-white dark:bg-dark-2 text-gray-700 dark:text-dark-6 transition-all duration-200">
                                            <svg id="sun-mobile" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707"/>
                                            </svg>
                                            <svg id="moon-mobile" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                                            </svg>
                                        </button>
                                        <button class="relative flex h-9 w-9 items-center justify-center rounded-xl border-[0.5px] border-gray-300 dark:border-dark-4 hover:bg-gray-100 dark:hover:bg-dark-4 bg-white dark:bg-dark-2 text-gray-700 dark:text-dark-6 transition-all duration-200">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                            </svg>
                                            <span class="absolute -right-0.5 -top-0.5 flex h-4 w-4 items-center justify-center rounded-full bg-red-600 text-[8px] font-medium text-white">
                                                4
                                            </span>
                                        </button>
                                    </div>
                                    @auth
                                        <li>
                                            <a href="{{ route('workspace') }}" wire:navigate
                                               class="flex items-center gap-3.5 text-sm font-medium text-gray-700 duration-300 ease-in-out hover:text-primary dark:text-dark-6 dark:hover:text-primary">
                                                <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22">
                                                    <path d="M11 9.62499C8.42188 9.62499 6.35938 7.59687 6.35938 5.12187C6.35938 2.64687 8.42188 0.618744 11 0.618744C13.5781 0.618744 15.6406 2.64687 15.6406 5.12187C15.6406 7.59687 13.5781 9.62499 11 9.62499ZM11 2.16562C9.28125 2.16562 7.90625 3.50624 7.90625 5.12187C7.90625 6.73749 9.28125 8.07812 11 8.07812C12.7188 8.07812 14.0938 6.73749 14.0938 5.12187C14.0938 3.50624 12.7188 2.16562 11 2.16562Z"/>
                                                    <path d="M17.7719 21.4156H4.2281C3.5406 21.4156 2.9906 20.8656 2.9906 20.1781V17.0844C2.9906 13.7156 5.7406 10.9656 9.1094 10.9656H12.925C16.2937 10.9656 19.0437 13.7156 19.0437 17.0844V20.1781C19.0094 20.8312 18.4594 21.4156 17.7719 21.4156ZM4.53748 19.8687H17.4969V17.0844C17.4969 14.575 15.4344 12.5125 12.925 12.5125H9.07498C6.5656 12.5125 4.5031 14.575 4.5031 17.0844V19.8687H4.53748Z"/>
                                                </svg>
                                                სამუშაო გვერდი
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('profile.show') }}" wire:navigate
                                               class="flex items-center gap-3.5 text-sm font-medium text-gray-700 duration-300 ease-in-out hover:text-primary dark:text-dark-6 dark:hover:text-primary">
                                                <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22">
                                                    <path d="M20.8656 8.86874C20.5219 8.49062 19.9469 8.49062 19.6031 8.86874C19.2594 9.24687 19.2594 9.82187 19.6031 10.2C20.4656 11.0625 21 12.2625 21 13.5687C21 16.2562 18.8219 18.4344 16.1344 18.4344C13.4469 18.4344 11.2688 16.2562 11.2688 13.5687C11.2688 12.2625 11.8031 11.0625 12.6656 10.2C13.0094 9.82187 13.0094 9.24687 12.6656 8.86874C12.3219 8.49062 11.7469 8.49062 11.4031 8.86874C10.2031 10.0687 9.45935 11.7469 9.45935 13.5687C9.45935 17.2219 12.4813 20.2437 16.1344 20.2437C19.7875 20.2437 22.8094 17.2219 22.8094 13.5687C22.8094 11.7469 22.0656 10.0687 20.8656 8.86874Z"/>
                                                    <path d="M16.1344 8.09998C17.7125 8.09998 19 6.81248 19 5.23435C19 3.65623 17.7125 2.36873 16.1344 2.36873C14.5563 2.36873 13.2688 3.65623 13.2688 5.23435C13.2688 6.81248 14.5563 8.09998 16.1344 8.09998Z"/>
                                                    <path d="M10.4594 13.9781C10.8031 13.6 10.8031 13.025 10.4594 12.6469C10.1156 12.2688 9.54062 12.2688 9.16249 12.6469C8.33749 13.4719 7.80312 14.6719 7.80312 15.9781C7.80312 17.2844 8.33749 18.4844 9.16249 19.3094C9.33124 19.4781 9.57812 19.5625 9.79062 19.5625C10.0031 19.5625 10.25 19.4781 10.4188 19.3094C10.7625 18.9313 10.7625 18.3563 10.4188 17.9781C9.92187 17.4813 9.61249 16.7656 9.61249 15.9781C9.61249 15.1906 9.92187 14.475 10.4594 13.9781Z"/>
                                                    <path d="M5.86875 10.5C7.44688 10.5 8.73438 9.2125 8.73438 7.63438C8.73438 6.05625 7.44688 4.76875 5.86875 4.76875C4.29063 4.76875 3.00313 6.05625 3.00313 7.63438C3.00313 9.2125 4.29063 10.5 5.86875 10.5Z"/>
                                                    <path d="M9.1625 5.23438C9.1625 3.88125 9.8625 2.63438 11.0281 1.81875C11.4062 1.54063 11.475 1 11.1969 0.621875C10.9188 0.24375 10.3781 0.175 10 0.453125C8.36563 1.60938 7.35938 3.33125 7.35938 5.23438C7.35938 7.1375 8.36563 8.85938 10 10.0156C10.1688 10.1844 10.4156 10.2688 10.6281 10.2688C10.8406 10.2688 11.0875 10.1844 11.2562 10.0156C11.6344 9.6375 11.6344 9.0625 11.2562 8.68438C9.8625 7.83438 9.1625 6.5875 9.1625 5.23438Z"/>
                                                </svg>
                                                პროფილის პარამეტრები
                                            </a>
                                        </li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit"
                                                       class="flex w-full items-center gap-3.5 text-sm font-medium text-gray-700 duration-300 ease-in-out hover:text-primary dark:text-dark-6 dark:hover:text-primary">
                                                    <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22">
                                                        <path d="M17.6687 1.44374C17.1187 0.893744 16.4312 0.618744 15.675 0.618744H7.42498C6.25623 0.618744 5.25935 1.58124 5.25935 2.78437V4.12499H4.29685C3.88435 4.12499 3.50623 4.46874 3.50623 4.91562C3.50623 5.36249 3.84998 5.70624 4.29685 5.70624H5.25935V10.2781H4.29685C3.88435 10.2781 3.50623 10.6219 3.50623 11.0687C3.50623 11.4812 3.84998 11.8594 4.29685 11.8594H5.25935V16.4312H4.29685C3.88435 16.4312 3.50623 16.775 3.50623 17.2219C3.50623 17.6687 3.84998 18.0125 4.29685 18.0125H5.25935V19.25C5.25935 20.4187 6.22185 21.4156 7.42498 21.4156H15.675C17.2218 21.4156 18.4937 20.1437 18.5281 18.5969V3.47187C18.4937 2.68124 18.2187 1.95937 17.6687 1.44374Z"/>
                                                    </svg>
                                                    გასვლა
                                                </button>
                                            </form>
                                        </li>
                                    @endauth
                                </ul>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center gap-3">
                            <!-- Dark Mode Toggle for Guests -->
                            <button onclick="toggleDarkMode()" class="darkswitcher flex h-9 w-9 items-center justify-center rounded-xl border-[0.5px] border-gray-300 dark:border-dark-4 hover:bg-gray-100 dark:hover:bg-dark-4 bg-white dark:bg-dark-2 text-gray-700 dark:text-dark-6 transition-all duration-200">
                                <svg id="sun-guest" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707"/>
                                </svg>
                                <svg id="moon-guest" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                                </svg>
                            </button>
                            
                            <a href="{{ route('register') }}" wire:navigate 
                               class="bg-primary-600 text-white px-5 py-2.5 rounded-xl hover:bg-primary-700 transition-all duration-200 shadow-lg shadow-primary-500/20 font-medium border border-primary-500/20 hover:border-primary-500/30 hover:scale-[1.02] active:scale-[0.98]">
                                რეგისტრაცია
                            </a>
                            <a href="{{ route('login') }}" wire:navigate 
                               class="bg-white dark:bg-dark-2 text-gray-700 dark:text-gray-300 px-5 py-2.5 rounded-xl hover:bg-gray-50 dark:hover:bg-dark-3 transition-all duration-200 shadow-md border border-gray-200 dark:border-gray-700 font-medium hover:scale-[1.02] active:scale-[0.98]">
                                შესვლა
                            </a>
                        </div>
                    @endauth

                </div>

                <div class="lg:hidden" x-data="{ 
                    mobileMenuOpen: false,
                    init() {
                        this.$watch('mobileMenuOpen', (value) => {
                            if (value) {
                                document.body.style.overflow = 'hidden';
                                document.body.style.position = 'fixed';
                                document.body.style.width = '100%';
                                document.body.style.top = `-${window.scrollY}px`;
                            } else {
                                const scrollY = document.body.style.top;
                                document.body.style.overflow = '';
                                document.body.style.position = '';
                                document.body.style.width = '';
                                document.body.style.top = '';
                                window.scrollTo(0, parseInt(scrollY || '0') * -1);
                            }
                        });
                    }
                }">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" 
                            class="fixed top-4 right-4 z-50 lg:hidden p-2 rounded-lg bg-white dark:bg-dark-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-dark-4 focus:outline-none border border-gray-200 dark:border-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!mobileMenuOpen" 
                                  stroke-linecap="round" 
                                  stroke-linejoin="round" 
                                  stroke-width="2" 
                                  d="M4 6h16M4 12h16M4 18h16"/>
                            <path x-show="mobileMenuOpen" 
                                  stroke-linecap="round" 
                                  stroke-linejoin="round" 
                                  stroke-width="2" 
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    
                    <!-- Mobile Menu (md and down) -->
                    <div x-show="mobileMenuOpen" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 -translate-y-8"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 -translate-y-8"
                         @click.away="mobileMenuOpen = false"
                         class="lg:hidden fixed inset-0 z-40 bg-white dark:bg-dark"
                         style="display: none;">
                        <!-- Header with Logo -->
                        <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
                            <a href="/" wire:navigate @click="mobileMenuOpen = false" class="flex items-center space-x-2 text-2xl font-bold text-primary-600 dark:text-primary-400">
                                <x-application-logo />
                            </a>
                            <button @click="mobileMenuOpen = false" 
                                    class="p-2 rounded-lg bg-gray-100 dark:bg-dark-2 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-dark-4 transition-all duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Menu Content -->
                        <div class="flex flex-col h-full overflow-y-auto">
                            <div class="flex-1 px-6 py-8 pb-20">
                                <div class="max-w-sm mx-auto space-y-8">
                                    <!-- Main Navigation -->
                                    <div class="space-y-4">
                                        <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-6">
                                            მთავარი მენიუ
                                        </h3>
                                        <a href="/" wire:navigate @click="mobileMenuOpen = false" 
                                           class="flex items-center space-x-4 text-lg font-medium text-gray-900 dark:text-white hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200 py-4 px-6 rounded-xl hover:bg-gray-50 dark:hover:bg-dark-2 group">
                                            <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-primary-100 dark:bg-primary-900/30 group-hover:bg-primary-200 dark:group-hover:bg-primary-800/50 transition-all duration-200">
                                                <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                                </svg>
                                            </div>
                                            <span>მთავარი</span>
                                        </a>
                                        <a href="/tutorials" wire:navigate @click="mobileMenuOpen = false" 
                                           class="flex items-center space-x-4 text-lg font-medium text-gray-900 dark:text-white hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200 py-4 px-6 rounded-xl hover:bg-gray-50 dark:hover:bg-dark-2 group">
                                            <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-purple-100 dark:bg-purple-900/30 group-hover:bg-purple-200 dark:group-hover:bg-purple-800/50 transition-all duration-200">
                                                <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                            <span>ვიდეო გაკვეთილები</span>
                                        </a>
                                        <a href="/pricing" wire:navigate @click="mobileMenuOpen = false" 
                                           class="flex items-center space-x-4 text-lg font-medium text-gray-900 dark:text-white hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200 py-4 px-6 rounded-xl hover:bg-gray-50 dark:hover:bg-dark-2 group">
                                            <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900/30 group-hover:bg-green-200 dark:group-hover:bg-green-800/50 transition-all duration-200">
                                                <svg class="w-7 h-7 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                                </svg>
                                            </div>
                                            <span>ფასები</span>
                                        </a>
                                        <a href="/about" wire:navigate @click="mobileMenuOpen = false" 
                                           class="flex items-center space-x-4 text-lg font-medium text-gray-900 dark:text-white hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200 py-4 px-6 rounded-xl hover:bg-gray-50 dark:hover:bg-dark-2 group">
                                            <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-orange-100 dark:bg-orange-900/30 group-hover:bg-orange-200 dark:group-hover:bg-orange-800/50 transition-all duration-200">
                                                <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            </div>
                                            <span>ჩვენს შესახებ</span>
                                        </a>
                                    </div>

                                    <!-- User Profile Section (for authenticated users) -->
                                    @auth
                                    <div class="space-y-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                                        <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-6">
                                            პროფილი
                                        </h3>
                                        <div x-data="{ open: false }" class="">
                                            <button @click="open = !open" class="flex items-center w-full space-x-4 p-4 rounded-xl bg-gray-50 dark:bg-dark-2 border border-gray-200 dark:border-gray-700 focus:outline-none">
                                                <div class="flex-shrink-0">
                                                    @if(auth()->user()->profile_photo_path)
                                                        <img class="w-12 h-12 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600" 
                                                             src="{{ Storage::url(auth()->user()->profile_photo_path) }}" 
                                                             alt="{{ auth()->user()->name }}">
                                                    @else
                                                        <div class="w-12 h-12 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center border-2 border-gray-200 dark:border-gray-600">
                                                            <svg class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                            </svg>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="flex-1 min-w-0 text-left">
                                                    <p class="text-lg font-semibold text-gray-900 dark:text-white truncate">
                                                        {{ auth()->user()->name }}
                                                    </p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400 truncate">
                                                        {{ auth()->user()->email }}
                                                    </p>
                                                </div>
                                                <svg :class="{'rotate-180': open}" class="w-5 h-5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>
                                            <div x-show="open" x-transition class="mt-2 space-y-2">
                                                <a href="{{ route('workspace') }}" wire:navigate @click="mobileMenuOpen = false"
                                                   class="flex items-center space-x-4 text-lg font-medium text-gray-900 dark:text-white hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200 py-3 px-6 rounded-xl hover:bg-gray-50 dark:hover:bg-dark-2 group">
                                                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-indigo-100 dark:bg-indigo-900/30 group-hover:bg-indigo-200 dark:group-hover:bg-indigo-800/50 transition-all duration-200">
                                                        <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                                        </svg>
                                                    </div>
                                                    <span>სამუშაო გვერდი</span>
                                                </a>
                                                <a href="{{ route('profile.show') }}" wire:navigate @click="mobileMenuOpen = false"
                                                   class="flex items-center space-x-4 text-lg font-medium text-gray-900 dark:text-white hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200 py-3 px-6 rounded-xl hover:bg-gray-50 dark:hover:bg-dark-2 group">
                                                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/30 group-hover:bg-blue-200 dark:group-hover:bg-blue-800/50 transition-all duration-200">
                                                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                        </svg>
                                                    </div>
                                                    <span>პროფილის პარამეტრები</span>
                                                </a>
                                                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                                                    @csrf
                                                    <button type="submit"
                                                            class="flex w-full items-center space-x-4 text-lg font-medium text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 transition-all duration-200 py-3 px-6 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/20 group">
                                                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-red-100 dark:bg-red-900/30 group-hover:bg-red-200 dark:group-hover:bg-red-800/50 transition-all duration-200">
                                                            <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                                            </svg>
                                                        </div>
                                                        <span>გასვლა</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endauth

                                    <!-- Dark Mode Toggle -->
                                    <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                                        <div class="relative p-6 rounded-xl bg-gray-50 dark:bg-dark-2 border border-gray-200 dark:border-gray-700">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-4">
                                                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-200 dark:bg-gray-700">
                                                        <svg id="sun-menu-icon" class="w-5 h-5 text-yellow-500 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707"/>
                                                        </svg>
                                                        <svg id="moon-menu-icon" class="w-5 h-5 text-indigo-500 dark:text-indigo-400 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <button onclick="toggleDarkMode()" 
                                                        class="relative flex h-12 w-20 items-center rounded-full bg-gray-200 dark:bg-gray-700 p-1 transition-all duration-300 hover:bg-gray-300 dark:hover:bg-gray-600">
                                                    <div id="toggle-slider" class="h-10 w-10 bg-white dark:bg-gray-800 rounded-full shadow-sm transition-all duration-300 ease-out flex items-center justify-center">
                                                        <svg id="sun-toggle" class="h-5 w-5 text-yellow-500 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707"/>
                                                        </svg>
                                                        <svg id="moon-toggle" class="h-5 w-5 text-indigo-500 hidden transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                                                        </svg>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section Start -->
    <section class="relative overflow-hidden pt-24 px-12 dark:bg-dark">
        <div class="absolute inset-0 bg-white dark:bg-dark -z-10"></div>
        <div class="absolute inset-0 opacity-30 -z-10 bg-pattern dark:opacity-10"></div>
        
        <livewire:banners />
    </section>
    <!-- Rest of your layout -->
    <main class="max-w-[120rem] mx-auto px-6 sm:px-8 lg:px-12 dark:bg-dark">
        {{ $slot }}
    </main>

    <!-- Footer Section -->
    <footer class="bg-white dark:bg-dark border-t border-gray-100 dark:border-gray-800 py-8 md:py-12">
        <div class="max-w-[120rem] mx-auto px-4 sm:px-6 lg:px-12">
            <div class="flex flex-col items-center space-y-6 md:space-y-8">
                <!-- Navigation Links -->
                <nav class="grid grid-cols-2 sm:grid-cols-3 md:flex md:flex-row gap-4 md:gap-8 text-center md:text-left w-full md:w-auto md:justify-center">
                    <a href="/" wire:navigate class="text-lg md:text-xl font-bold text-gray-900 dark:text-white hover:text-primary-600 dark:hover:text-primary-400 transition-colors">GIPC</a>
                    <a href="/about" wire:navigate class="text-sm md:text-base text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">ჩვენს შესახებ</a>
                    <a href="/contact" wire:navigate class="text-sm md:text-base text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">კონტაქტი</a>
                    <a href="{{ route('regulations') }}" wire:navigate class="text-sm md:text-base text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">სამშენებლო რეგულაციები</a>
                    <a href="{{ route('terms-and-conditions') }}" wire:navigate class="text-sm md:text-base text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">წესები და პირობები</a>
                    <a href="{{ route('privacy-policy') }}" wire:navigate class="text-sm md:text-base text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">კონფიდენციალურობის პოლიტიკა</a>
                </nav>
                
                <!-- Social Links and Copyright -->
                <div class="flex flex-col md:flex-row items-center gap-4 md:gap-6 w-full justify-center">
                    <div class="flex items-center gap-6 md:gap-4">
                        <a href="#" wire:navigate class="text-xl md:text-lg text-gray-400 dark:text-gray-500 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" wire:navigate class="text-xl md:text-lg text-gray-400 dark:text-gray-500 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a href="#" wire:navigate class="text-xl md:text-lg text-gray-400 dark:text-gray-500 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                    <span class="hidden md:block text-gray-400 dark:text-gray-500">|</span>
                    <span class="text-sm md:text-base text-gray-600 dark:text-gray-400">© 2025 GIPC</span>
                </div>
            </div>
        </div>
    </footer>

    @livewireScripts()

    <!-- Dark mode script -->
    <script>
        function toggleDarkMode() {
            const body = document.getElementById('body');
            const isDark = body.classList.contains('dark-mode');
            
            if (isDark) {
                // Switch to light mode
                body.classList.remove('dark-mode');
                document.documentElement.classList.remove('dark');
                localStorage.setItem('darkMode', 'false');
                showSun();
            } else {
                // Switch to dark mode
                body.classList.add('dark-mode');
                document.documentElement.classList.add('dark');
                localStorage.setItem('darkMode', 'true');
                showMoon();
            }
        }
        
        function showSun() {
            // Show sun icons (light mode - can switch to dark)
            document.querySelectorAll('#sun, #sun-mobile, #sun-guest, #sun-menu, #sun-menu-icon, #sun-toggle').forEach(el => el.classList.remove('hidden'));
            document.querySelectorAll('#moon, #moon-mobile, #moon-guest, #moon-menu, #moon-menu-icon, #moon-toggle').forEach(el => el.classList.add('hidden'));
            
            // Move slider to left (light mode position)
            const slider = document.getElementById('toggle-slider');
            if (slider) {
                slider.style.transform = 'translateX(0px)';
            }
        }
        
        function showMoon() {
            // Show moon icons (dark mode - can switch to light)
            document.querySelectorAll('#sun, #sun-mobile, #sun-guest, #sun-menu, #sun-menu-icon, #sun-toggle').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('#moon, #moon-mobile, #moon-guest, #moon-menu, #moon-menu-icon, #moon-toggle').forEach(el => el.classList.remove('hidden'));
            
            // Move slider to right (dark mode position)
            const slider = document.getElementById('toggle-slider');
            if (slider) {
                slider.style.transform = 'translateX(32px)'; // 32px (w-20 - w-10 - padding)
            }
        }
        
        function initializeDarkMode() {
            const isDark = localStorage.getItem('darkMode') === 'true';
            
            if (isDark) {
                document.getElementById('body').classList.add('dark-mode');
                document.documentElement.classList.add('dark');
                showMoon();
            } else {
                document.getElementById('body').classList.remove('dark-mode');
                document.documentElement.classList.remove('dark');
                showSun();
            }
        }
        
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', initializeDarkMode);
        
        // Initialize on Livewire navigation
        document.addEventListener('livewire:navigated', initializeDarkMode);
        
        // Also listen for Livewire load events
        document.addEventListener('livewire:load', initializeDarkMode);
        
        // Listen for any Livewire updates
        document.addEventListener('livewire:update', initializeDarkMode);
        
        // Listen for browser back/forward navigation
        window.addEventListener('popstate', initializeDarkMode);
        
        // Listen for URL changes (for SPA navigation)
        let currentUrl = location.href;
        const observer = new MutationObserver(() => {
            if (location.href !== currentUrl) {
                currentUrl = location.href;
                setTimeout(initializeDarkMode, 100);
            }
        });
        observer.observe(document, { subtree: true, childList: true });
        
        // Fallback: check every second for the first 5 seconds after page load
        let checkCount = 0;
        const checkInterval = setInterval(() => {
            checkCount++;
            if (checkCount <= 5) {
                initializeDarkMode();
            } else {
                clearInterval(checkInterval);
            }
        }, 1000);
        
        // Additional fallback: check when window gains focus (user returns to tab)
        window.addEventListener('focus', initializeDarkMode);
        
        // Check on any DOM changes
        const darkModeObserver = new MutationObserver(() => {
            // Only reinitialize if dark mode is not properly set
            const body = document.getElementById('body');
            const isDark = localStorage.getItem('darkMode') === 'true';
            const hasDarkClass = body.classList.contains('dark-mode');
            
            if (isDark !== hasDarkClass) {
                initializeDarkMode();
            }
        });
        
        // Start observing after a short delay
        setTimeout(() => {
            darkModeObserver.observe(document.body, { 
                attributes: true, 
                attributeFilter: ['class'],
                subtree: true 
            });
        }, 1000);
    </script>

</body>

</html>