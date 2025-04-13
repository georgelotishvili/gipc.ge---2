<!doctype html>
<html lang="en" class="scroll-smooth dark"
    x-data="{ 
        sidebarOpen: localStorage.getItem('sidebarOpen') === 'true',
        toggleSidebar() {
            this.sidebarOpen = !this.sidebarOpen;
            localStorage.setItem('sidebarOpen', this.sidebarOpen);
        },
        mobileMenuOpen: false
    }" 
    x-cloak>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>GIPC</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="dark:bg-dark">
    <!-- ====== Navbar Section Start -->
    <nav class="fixed w-full bg-white/80 dark:bg-dark top-0 z-50 border-b border-gray-100 dark:border-gray-800">
        <div class="max-w-[120rem] mx-auto px-6 sm:px-8 lg:px-12">
            <div class="flex justify-between h-20 items-center">
                <div class="flex-shrink-0">
                    <a href="/" wire:navigate class="flex items-center space-x-2 text-2xl font-bold text-primary-600 dark:text-primary-400">
                        <x-application-logo />
                    </a>
                </div>

                <div class="hidden lg:flex items-center justify-between flex-grow">
                    <div class="flex items-center space-x-8 mx-auto">
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

                    @auth
                        <div class="flex items-center gap-2 sm:gap-3 2xsm:gap-7">
                            <!-- Desktop Notifications and Dark Mode (xl and up) -->
                            <ul class="hidden xl:flex items-center gap-2 2xsm:gap-4">
                                <!-- Theme Toggle -->
                                @if (auth()->user()->is_admin)
                                    <li>
                                        <a href="/admin" wire:navigate class="flex h-9 items-center justify-center rounded-xl border-[0.5px] border-gray-300 px-4 hover:bg-gray-100 dark:border-dark-4 dark:bg-dark-2 dark:text-dark-6 dark:hover:bg-dark-4">
                                            ადმინ პანელი
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <button class="darkswitcher flex h-9 w-9 items-center justify-center rounded-xl border-[0.5px] border-gray-300 hover:bg-gray-100 dark:border-dark-4 dark:bg-dark-2 dark:text-dark-6 dark:hover:bg-dark-4">
                                        <svg class="h-5 w-5 dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707"/>
                                        </svg>
                                        <svg class="h-5 w-5 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                                        </svg>
                                    </button>
                                </li>

                                <!-- Notifications -->
                                <li>
                                    <button class="relative flex h-9 w-9 items-center justify-center rounded-xl border-[0.5px] border-gray-300 hover:bg-gray-100 dark:border-dark-4 dark:bg-dark-2 dark:text-dark-6 dark:hover:bg-dark-4">
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
                            <div x-data="{ dropdownOpen: false }" class="relative">
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
                                            <button class="flex h-9 w-9 items-center justify-center rounded-xl border-[0.5px] border-gray-300 hover:bg-gray-100 dark:border-dark-4 dark:bg-dark-2 dark:text-dark-6 dark:hover:bg-dark-4">
                                                <svg class="h-5 w-5 dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707"/>
                                                </svg>
                                                <svg class="h-5 w-5 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                                                </svg>
                                            </button>
                                            <button class="relative flex h-9 w-9 items-center justify-center rounded-xl border-[0.5px] border-gray-300 hover:bg-gray-100 dark:border-dark-4 dark:bg-dark-2 dark:text-dark-6 dark:hover:bg-dark-4">
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
                        </div>
                    @else
                        <div class="flex items-center gap-2 sm:gap-4">
                            <a href="{{ route('login') }}" wire:navigate class="bg-primary-600 dark:bg-primary-500 text-white px-5 py-2.5 rounded-lg hover:bg-primary-700 dark:hover:bg-primary-600 transition-colors shadow-lg shadow-primary-500/20 dark:shadow-primary-500/10">
                                დაწყება
                            </a>
                        </div>
                    @endauth

                </div>

                <div class="lg:hidden">
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
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu (md and down) -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="lg:hidden fixed inset-0 z-40 bg-white dark:bg-dark pt-20">
        <div class="container mx-auto px-6 py-8">
            <div class="flex flex-col space-y-6">
                <a href="/" wire:navigate class="text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium text-lg">
                    მთავარი
                </a>
                <a href="/tutorials" wire:navigate class="text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium text-lg">
                    ვიდეო გაკვეთილები
                </a>
                <a href="/pricing" wire:navigate class="text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium text-lg">
                    ფასები
                </a>
                <a href="/about" wire:navigate class="text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium text-lg">
                    ჩვენს შესახებ
                </a>
                @guest
                    <a href="{{ route('login') }}" wire:navigate class="text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium text-lg">
                        შესვლა
                    </a>
                @else
                    <a href="{{ route('workspace') }}" wire:navigate class="text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium text-lg">
                        სამუშაო გვერდი
                    </a>
                    <a href="{{ route('logout') }}" wire:navigate class="text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium text-lg">
                        გასვლა
                    </a>
                @endguest
                <button class="flex h-9 w-9 items-center justify-center rounded-xl border-[0.5px] border-gray-300 hover:bg-gray-100 dark:border-dark-4 dark:bg-dark-2 dark:text-dark-6 dark:hover:bg-dark-4">
                    <svg class="h-5 w-5 dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707"/>
                    </svg>
                    <svg class="h-5 w-5 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
  <!-- Hero Section Start -->
  <section class="relative overflow-hidden pt-24 px-12 dark:bg-dark">
        <div class="absolute inset-0 bg-white dark:bg-dark -z-10"></div>
        <div class="absolute inset-0 opacity-30 -z-10 bg-pattern dark:opacity-10"></div>
        
        <!-- Banner Slider -->
        <div x-data="{ 
            currentSlide: parseInt(localStorage.getItem('currentSlide')) || 0,
            slides: [
                { image: 'https://picsum.photos/1600/900?random=1', title: 'პროფესიული სერტიფიცირება', subtitle: 'საერთაშორისო სტანდარტებით' },
                { image: 'https://picsum.photos/1600/900?random=2', title: 'ISO სტანდარტების შესაბამისად', subtitle: 'კვალიფიკაციის ამაღლება' },
                { image: 'https://picsum.photos/1600/900?random=3', title: 'საერთაშორისო გამოცდილება', subtitle: 'პროფესიონალთა გუნდი' },
                { image: 'https://picsum.photos/1600/900?random=4', title: 'სერტიფიცირების პროგრამები', subtitle: 'თანამედროვე მიდგომები' },
                { image: 'https://picsum.photos/1600/900?random=5', title: 'უწყვეტი განათლება', subtitle: 'პროფესიული ზრდა' },
                { image: 'https://picsum.photos/1600/900?random=6', title: 'ხარისხის გარანტია', subtitle: 'საერთაშორისო აღიარება' },
                { image: 'https://picsum.photos/1600/900?random=7', title: 'ინოვაციური სწავლება', subtitle: 'თანამედროვე მეთოდები' },
                { image: 'https://picsum.photos/1600/900?random=8', title: 'პრაქტიკული გამოცდილება', subtitle: 'რეალური პროექტები' },
                { image: 'https://picsum.photos/1600/900?random=9', title: 'კარიერული წინსვლა', subtitle: 'პროფესიული განვითარება' },
                { image: 'https://picsum.photos/1600/900?random=10', title: 'გლობალური სტანდარტები', subtitle: 'ლოკალური ექსპერტიზა' }
            ]
         }"
         x-init="
            setInterval(() => { 
                currentSlide = (currentSlide + 1) % slides.length;
                localStorage.setItem('currentSlide', currentSlide);
            }, 4000);
            $watch('currentSlide', value => localStorage.setItem('currentSlide', value));"
         class="relative max-w-[120rem] mx-auto mb-16">
            
            <!-- Slides Container -->
            <div class="relative h-[300px] overflow-hidden rounded-3xl">
                <template x-for="(slide, index) in slides" :key="index">
                    <div x-show="currentSlide === index"
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 transform translate-x-full"
                         x-transition:enter-end="opacity-100 transform translate-x-0"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100 transform translate-x-0"
                         x-transition:leave-end="opacity-0 transform -translate-x-full"
                         class="absolute inset-0">
                        <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-black/30"></div>
                        <img :src="slide.image" :alt="slide.title" 
                             class="w-full h-full object-cover">
                        <div class="absolute bottom-0 left-0 right-0 p-12 text-white">
                            <h2 class="text-4xl font-bold mb-4" x-text="slide.title"></h2>
                            <p class="text-xl" x-text="slide.subtitle"></p>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Navigation Dots -->
            <!-- <div class="flex justify-center gap-3 mt-6">
                <template x-for="(slide, index) in slides" :key="index">
                    <button @click="currentSlide = index"
                            :class="{ 'bg-primary-600': currentSlide === index, 'bg-gray-300 dark:bg-gray-700': currentSlide !== index }"
                            class="w-3 h-3 rounded-full transition-colors duration-200">
                    </button>
                </template>
            </div> -->
        </div>
    </section>
    <!-- Rest of your layout -->
    <main class="max-w-[120rem] mx-auto px-6 sm:px-8 lg:px-12 dark:bg-dark">
        {{ $slot }}
    </main>

    <!-- Footer Section -->
    <footer class="bg-white dark:bg-dark border-t border-gray-100 dark:border-gray-800 py-12">
        <div class="max-w-[120rem] mx-auto px-6 sm:px-8 lg:px-12">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-8">
                    <a href="/" wire:navigate class="text-xl font-bold text-gray-900 dark:text-white">GIPC</a>
                    <a href="/about" wire:navigate class="text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">ჩვენს შესახებ</a>
                    <a href="/contact" wire:navigate class="text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">კონტაქტი</a>
                </div>
                
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-4">
                        <a href="#" wire:navigate class="text-gray-400 dark:text-gray-500 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" wire:navigate class="text-gray-400 dark:text-gray-500 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a href="#" wire:navigate class="text-gray-400 dark:text-gray-500 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                    <span class="text-gray-400 dark:text-gray-500">|</span>
                    <span class="text-gray-600 dark:text-gray-400">© 2024 GIPC</span>
                </div>
            </div>
        </div>
    </footer>

</body>

<script>
    // Initialize dark mode on page load
    if (localStorage.getItem('darkMode') === 'true') {
        document.documentElement.classList.add('dark');
    }

    document.addEventListener("DOMContentLoaded", function () {
        const darkModeToggle = document.querySelector(".darkswitcher");
        const html = document.documentElement;
        
        // Check localStorage for dark mode preference
        if (localStorage.getItem("theme") === "dark") {
            html.classList.add("dark");
        }
    
        // Toggle dark mode on button click
        darkModeToggle.addEventListener("click", () => {
            if (html.classList.contains("dark")) {
                html.classList.remove("dark");
                localStorage.setItem("theme", "light");
            } else {
                html.classList.add("dark");
                localStorage.setItem("theme", "dark");
            }
        });
    });
</script>

<script>
    // Theme toggle functionality
    const html = document.documentElement;
    const themeToggles = document.querySelectorAll('[name="themeSwitcher"], [name="mobileThemeSwitcher"]');
    
    // Function to set theme
    function setTheme(isDark) {
        if (isDark) {
            html.classList.add('dark');
            localStorage.theme = 'dark';
            themeToggles.forEach(toggle => toggle.checked = true);
        } else {
            html.classList.remove('dark');
            localStorage.theme = 'light';
            themeToggles.forEach(toggle => toggle.checked = false);
        }
    }

    // Check initial theme
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        setTheme(true);
    } else {
        setTheme(false);
    }

    // Handle toggle clicks
    themeToggles.forEach(toggle => {
        toggle.addEventListener('change', (e) => {
            setTheme(e.target.checked);
        });
    });

    // Mobile menu functionality
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const mobileMenu = document.getElementById('mobileMenu');
    const menuIcon = document.getElementById('menuIcon');
    const closeIcon = document.getElementById('closeIcon');

    mobileMenuButton?.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
        menuIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
    });
</script>

<style>
    [x-cloak] {
        display: block !important;
    }
</style>

</html>
