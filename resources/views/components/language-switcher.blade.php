@props(['currentLocale' => app()->getLocale()])

<div class="relative inline-block text-left">
    <div>
        <button type="button" 
                class="inline-flex items-center px-2 py-1.5 sm:px-3 sm:py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-xs sm:text-sm leading-4 font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200"
                id="language-menu-button"
                aria-expanded="true"
                aria-haspopup="true">
            @if($currentLocale === 'ka')
                <span class="hidden sm:inline">🇬🇪 ქართული</span>
                <span class="sm:hidden">🇬🇪</span>
            @else
                <span class="hidden sm:inline">🇺🇸 English</span>
                <span class="sm:hidden">🇺🇸</span>
            @endif
            <svg class="-mr-1 ml-1 sm:ml-2 h-3 w-3 sm:h-4 sm:w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>

    <div class="hidden origin-top-right absolute right-0 mt-2 w-28 sm:w-32 rounded-md shadow-lg bg-white dark:bg-gray-700 ring-1 ring-black ring-opacity-5 focus:outline-none z-50" 
         role="menu" 
         aria-orientation="vertical" 
         aria-labelledby="language-menu-button" 
         tabindex="-1"
         id="language-menu">
        <div class="py-1" role="none">
            <a href="{{ route('language.switch', 'en') }}" 
               class="block px-3 sm:px-4 py-2 text-xs sm:text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200 {{ $currentLocale === 'en' ? 'bg-gray-100 dark:bg-gray-600' : '' }}"
               role="menuitem" 
               tabindex="-1">
                🇺🇸 English
            </a>
            <a href="{{ route('language.switch', 'ka') }}" 
               class="block px-3 sm:px-4 py-2 text-xs sm:text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200 {{ $currentLocale === 'ka' ? 'bg-gray-100 dark:bg-gray-600' : '' }}"
               role="menuitem" 
               tabindex="-1">
                🇬🇪 ქართული
            </a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const button = document.getElementById('language-menu-button');
    const menu = document.getElementById('language-menu');
    
    if (button && menu) {
        button.addEventListener('click', function() {
            menu.classList.toggle('hidden');
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!button.contains(event.target) && !menu.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });
    }
});
</script> 