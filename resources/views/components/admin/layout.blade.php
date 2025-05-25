<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="font-family: 'DejaVu Sans Condensed', sans-serif;"
 x-data="{ 
          sidebarOpen: localStorage.getItem('sidebarOpen') === 'true', 
          darkMode: localStorage.getItem('darkMode') === 'true',
          toggleSidebar() { 
              this.sidebarOpen = !this.sidebarOpen;
              localStorage.setItem('sidebarOpen', this.sidebarOpen);
          },
          toggleDarkMode() {
              this.darkMode = !this.darkMode;
              localStorage.setItem('darkMode', this.darkMode);
              if (this.darkMode) {
                  document.documentElement.classList.add('dark');
              } else {
                  document.documentElement.classList.remove('dark');
              }
          }
      }" 
      :class="{ 'dark': darkMode }"
      class="bg-gray-50 dark:bg-dark">
    <head>
        <link rel="stylesheet" href="/node_modules/dejavu-sans-condensed/css/dejavu-sans-condensed.min.css">
        <script>
            if (localStorage.getItem('darkMode') === 'true' || (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- <script src="//unpkg.com/alpinejs" defer></script> -->
        <title>{{ config('app.name', 'Laravel') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased dark:bg-dark">
        <div class="flex min-h-screen bg-gray-50 dark:bg-dark">
            <x-admin.sidebar />

            <!-- Main Content -->
            <div class="flex-1 flex flex-col"
                 :class="{ 
                     'lg:pl-64': sidebarOpen,
                     'lg:pl-20': !sidebarOpen
                 }">
                <x-admin.header />
                
                <main class="flex-1 p-4 lg:p-6 2xl:p-10">
                    {{ $slot }}
                </main>
            </div>
        </div>

        <script>
            // Initialize dark mode on page load
            if (localStorage.getItem('darkMode') === 'true') {
                document.documentElement.classList.add('dark');
            }
        </script>
    
    @livewireScripts

        @stack('scripts')
    </body>
</html>
