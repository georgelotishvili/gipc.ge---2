<div class="relative flex-1" x-data="{ isOpen: false }">
    <div class="relative group">
        <input
            wire:model.live="search"
            @focus="isOpen = true"
            @click.away="isOpen = false"
            type="text"
            class="w-full pl-12 pr-4 py-2.5 text-gray-700 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-dark-2 border-2 border-gray-100 dark:border-dark-4 rounded-xl focus:border-primary/30 dark:focus:border-primary/30 focus:ring-2 focus:ring-primary/10 dark:focus:ring-primary/10 transition-all duration-300 hover:border-gray-200 dark:hover:border-dark-3"
            placeholder="მოძებნეთ კითხვები..."
        >
        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
            <div class="h-7 w-7 rounded-lg bg-gradient-to-br from-primary/10 to-primary/5 dark:from-primary/20 dark:to-primary/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-primary-500 dark:text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>
    </div>

    @if($search && count($searchResults) > 0)
        <div 
            x-show="isOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-1"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-1"
            class="absolute z-50 w-[120%] -left-[10%] mt-2 bg-white dark:bg-dark-2 rounded-xl shadow-[0_15px_40px_-15px_rgba(0,0,0,0.2)] dark:shadow-[0_15px_40px_-15px_rgba(0,0,0,0.4)] border border-gray-100/50 dark:border-dark-4/50 divide-y divide-gray-100 dark:divide-dark-4"
        >
            @foreach($searchResults as $result)
                <a href="{{ route('admin.questions.edit', $result->id) }}" 
                   class="group flex items-start gap-4 px-5 py-4 hover:bg-gray-50 dark:hover:bg-dark-3 transition-colors duration-200 first:rounded-t-xl last:rounded-b-xl">
                    <div class="flex-shrink-0 h-7 w-7 rounded-lg bg-gray-100 dark:bg-dark-4 group-hover:bg-primary/10 dark:group-hover:bg-primary/10 flex items-center justify-center transition-colors duration-200">
                        <span class="text-xs font-medium text-gray-600 dark:text-gray-400">#{{ $result->id }}</span>
                    </div>
                    <div class="text-gray-700 dark:text-gray-200 text-sm">
                        {!! $this->highlightText($result->text, $search) !!}
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>