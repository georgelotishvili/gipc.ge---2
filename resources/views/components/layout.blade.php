<!doctype html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        
    <title>GIPC</title>
    @vite('resources/css/app.css')

</head>

<body>

    <!-- ====== Navbar Section Start -->
    <nav class="fixed w-full bg-white dark:bg-gray-900 z-50 border-b border-gray-100 dark:border-gray-800">
        <div class="max-w-[120rem] mx-auto px-6 sm:px-8 lg:px-12">
            <div class="flex justify-between h-20 items-center">
                <div class="flex-shrink-0">
                    <a href="/" class="flex items-center space-x-2 text-2xl font-bold text-primary-600">
                        <i class="fas fa-chart-bar h-8 w-8"></i>
                        <span>GIPC</span>
                    </a>
                </div>

                <div class="hidden md:flex items-center justify-between flex-grow">
                    <div class="flex items-center space-x-8 mx-auto">
                        <a href="/" class="text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium">
                            მთავარი
                        </a>
                        <a href="/features" class="text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium">
                            სერვისები
                        </a>
                        <a href="/pricing" class="text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium">
                            ფასები
                        </a>
                        <a href="/about" class="text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium">
                            ჩვენს შესახებ
                        </a>
                    </div>
                    
                    <div class="flex items-center space-x-6">
                        <!-- Theme Toggle -->
                        <label for="themeSwitcher" class="inline-flex cursor-pointer items-center" aria-label="themeSwitcher" name="themeSwitcher">
                            <input type="checkbox" name="themeSwitcher" id="themeSwitcher" class="sr-only" />
                            <span class="block text-gray-600 dark:text-gray-300">
                                <i class="fas fa-moon"></i>
                            </span>
                        </label>

                        <button class="bg-[#0066FF] text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition-all duration-300 shadow-lg shadow-blue-500/20 font-medium relative overflow-hidden hover:scale-105 active:scale-95 hover:shadow-blue-500/30 group">
                            <span class="relative z-10 flex items-center gap-2">
                                დაწყება
                                <i class="fas fa-arrow-right transform transition-transform duration-300 group-hover:translate-x-1"></i>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-blue-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </button>
                    </div>
                </div>

                <div class="md:hidden">
                    <button id="mobileMenuButton" class="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white p-2">
                        <i class="fas fa-bars text-2xl" id="menuIcon"></i>
                        <i class="fas fa-times text-2xl hidden" id="closeIcon"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobileMenu" class="hidden md:hidden">
            <div class="px-4 pt-2 pb-3 space-y-1 bg-white dark:bg-gray-900 shadow-lg border-t border-gray-100 dark:border-gray-800">
                <a href="/" class="block px-4 py-2.5 text-base font-medium text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors rounded-lg">
                    მთავარი
                </a>
                <a href="/features" class="block px-4 py-2.5 text-base font-medium text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors rounded-lg">
                    სერვისები
                </a>
                <a href="/pricing" class="block px-4 py-2.5 text-base font-medium text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors rounded-lg">
                    ფასები
                </a>
                <a href="/about" class="block px-4 py-2.5 text-base font-medium text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors rounded-lg">
                    ჩვენს შესახებ
                </a>
                <div class="flex items-center justify-between px-4 py-2.5">
                    <!-- Theme Toggle -->
                    <label for="mobileThemeSwitcher" class="inline-flex cursor-pointer items-center" aria-label="themeSwitcher">
                        <input type="checkbox" name="mobileThemeSwitcher" id="mobileThemeSwitcher" class="sr-only" />
                        <span class="block text-gray-600 dark:text-gray-300">
                            <i class="fas fa-moon"></i>
                        </span>
                    </label>
                    <button class="bg-[#0066FF] text-white px-5 py-2.5 rounded-lg hover:bg-blue-700 transition-colors shadow-lg shadow-blue-500/20">
                        დაწყება
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Rest of your layout -->
    <main class="max-w-[120rem] mx-auto px-6 sm:px-8 lg:px-12">
        {{ $slot }}
    </main>

    <!-- Footer Section -->
    <footer class="bg-white border-t border-gray-100 py-12">
        <div class="max-w-[120rem] mx-auto px-6 sm:px-8 lg:px-12">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-8">
                    <a href="/" class="text-xl font-bold text-gray-900">GIPC</a>
                    <a href="/about" class="text-gray-600 hover:text-primary-600 transition-colors">ჩვენს შესახებ</a>
                    <a href="/contact" class="text-gray-600 hover:text-primary-600 transition-colors">კონტაქტი</a>
                </div>
                
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-4">
                        <a href="#" class="text-gray-400 hover:text-primary-600 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-primary-600 transition-colors">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-primary-600 transition-colors">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                    <span class="text-gray-400">|</span>
                    <span class="text-gray-600">© 2024 GIPC</span>
                </div>
            </div>
        </div>
    </footer>


</body>
<!-- Add this script at the bottom of your layout file -->
    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');
        const menuIcon = document.getElementById('menuIcon');
        const closeIcon = document.getElementById('closeIcon');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });

        // Theme toggle functionality
        const themeToggles = document.querySelectorAll('[name="themeSwitcher"]');
        
        themeToggles.forEach(toggle => {
            toggle.addEventListener('change', () => {
                document.documentElement.classList.toggle('dark');
            });
        });
    </script>
</html>
