<x-layout>
    <div class="min-h-screen bg-gray-200 dark:bg-slate-800 pt-16 rounded-md">
        <div class="container mx-auto px-4 py-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <a href="{{ route('tutorials') }}" 
                   class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-4">
                    <i class="fas fa-arrow-left mr-2"></i>
                    უკან დაბრუნება
                </a>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                    {{ $course->name }}
                </h1>
                <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    {{ $course->description }}
                </p>
            </div>

            @if($course->chapters->count() > 0)
                <!-- Mobile Chapters (Simple) -->
                <div class="max-w-4xl mx-auto space-y-4 lg:hidden">
                    @foreach($course->chapters as $index => $chapter)
                        <div class="bg-white dark:bg-gray-800 rounded-md border border-gray-200 dark:border-gray-700" x-data="{ open: false }">
                            <!-- Chapter Header -->
                            <button @click="open = !open" class="w-full p-4 text-left hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                                            <span class="text-white font-bold text-sm">{{ $index + 1 }}</span>
                                        </div>
                                        <div>
                                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $chapter->name }}</h2>
                                            <div class="text-sm text-gray-500">
                                                {{ $chapter->videos->count() }} ვიდეო • {{ round(($chapter->videos->sum('duration') ?? 0) / 3600, 1) }}+ საათი
                                            </div>
                                        </div>
                                    </div>
                                    <i class="fas fa-chevron-down text-gray-400 transition-transform" :class="{ 'rotate-180': open }"></i>
                                </div>
                            </button>
                            
                            <!-- Videos -->
                            <div x-show="open" x-transition class="border-t border-gray-200 dark:border-gray-700">
                                <div class="p-4">
                                    <div class="space-y-3">
                                        @foreach($chapter->videos as $video)
                                            <livewire:video-card :video="$video" style="list" :key="$video->id" />
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Desktop Chapters (Enhanced) -->
                <div class="max-w-4xl mx-auto space-y-4 hidden lg:block">
                    @foreach($course->chapters as $index => $chapter)
                        <div class="bg-white dark:bg-gray-800 rounded-md shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md transition-all duration-300" x-data="{ open: false }">
                            <!-- Chapter Header (Enhanced) -->
                            <button @click="open = !open" class="w-full p-5 text-left focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-inset hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-md flex items-center justify-center shadow-lg flex-shrink-0">
                                            <span class="text-white font-bold text-lg">{{ $index + 1 }}</span>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $chapter->name }}</h2>
                                            <div class="flex items-center gap-3 text-sm text-gray-500 dark:text-gray-400">
                                                <span class="flex items-center gap-2 px-3 py-1.5 bg-blue-50 dark:bg-blue-900/20 rounded-md">
                                                    <i class="fas fa-video text-blue-500"></i>
                                                    <span class="font-medium">{{ $chapter->videos->count() }} ვიდეო</span>
                                                </span>
                                                <span class="flex items-center gap-2 px-3 py-1.5 bg-gray-50 dark:bg-gray-700 rounded-md">
                                                    <i class="fas fa-clock text-gray-500"></i>
                                                    <span class="font-medium">{{ round(($chapter->videos->sum('duration') ?? 0) / 3600, 1) }}+ საათი</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3 flex-shrink-0">
                                        <div class="text-right">
                                            <div class="text-sm text-gray-500 dark:text-gray-400 font-medium">დააჭირეთ გასახსნელად</div>
                                        </div>
                                        <div class="w-10 h-10 bg-gray-100 dark:bg-gray-700 rounded-md flex items-center justify-center transition-transform duration-300" :class="{ 'rotate-180': open }">
                                            <i class="fas fa-chevron-down text-gray-500"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-gray-600 dark:text-gray-300 mt-4 leading-relaxed">{{ $chapter->description }}</p>
                            </button>
                            
                            <!-- Videos (Enhanced) -->
                            <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform -translate-y-2" class="border-t border-gray-200 dark:border-gray-700">
                                <div class="p-5">
                                    <div class="space-y-3">
                                        @foreach($chapter->videos as $video)
                                            <livewire:video-card :video="$video" style="list" :key="$video->id" />
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-800 rounded-md flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-book-open text-2xl text-gray-400"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-2">თავები არ არის დამატებული</h3>
                    <p class="text-gray-500 dark:text-gray-400">
                        ამ კურსისთვის ჯერ არ არის დამატებული სასწავლო თავები
                    </p>
                </div>
            @endif
        </div>
    </div>

    @push('styles')
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    <style>
        [x-cloak] { display: none !important; }
    </style>
    @endpush

    @push('scripts')
    <script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>
    <script src="{{ asset('js/video-player.js') }}"></script>
    @endpush
</x-layout>
