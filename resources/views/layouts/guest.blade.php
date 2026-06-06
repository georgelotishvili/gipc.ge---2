<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

        <script>
            // On page load or when changing themes, best to add inline in `head` to avoid FOUC
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark')
            } else {
                document.documentElement.classList.remove('dark')
            }

            // Whenever the theme changes, update localStorage
            function toggleTheme() {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark')
                    localStorage.theme = 'light'
                } else {
                    document.documentElement.classList.add('dark')
                    localStorage.theme = 'dark'
                }
            }
        </script>
    </head>
    <body class="h-full bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
        <div class="font-sans text-gray-900 dark:text-gray-100 antialiased h-full">
            {{ $slot }}
        </div>

        @livewireScripts
    </body>
</html>
