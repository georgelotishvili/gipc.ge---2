<x-layout>
    <div class="min-h-screen bg-white dark:bg-dark relative overflow-hidden pt-16">
        <div class="relative z-10 container mx-auto px-6 py-16">
            <!-- Header -->
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">
                    <span class="bg-gradient-to-r from-primary-400 to-blue-400 bg-clip-text text-transparent">{{ $course->name }}</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                    {{ $course->description }}
                </p>
            </div>

            <!-- Back Button -->
            <div class="mb-8">
                <a href="{{ route('tutorials') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-gray-800 dark:text-white rounded-lg transition-colors duration-300 text-sm font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>
                    უკან დაბრუნება
                </a>
            </div>

            @if($course->chapters->count() > 0)
                <!-- Chapters List -->
                <div class="max-w-4xl mx-auto space-y-8">
                    @foreach($course->chapters as $chapter)
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden border border-gray-100 dark:border-gray-700">
                            <div class="p-6">
                                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ $chapter->name }}</h2>
                                <p class="text-gray-600 dark:text-gray-300 mb-6">{{ $chapter->description }}</p>
                                
                                @if($chapter->videos->count() > 0)
                                    <div class="space-y-4">
                                        @foreach($chapter->videos as $video)
                                            <livewire:video-card :video="$video" style="list" />
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                                        <i class="fas fa-video text-4xl mb-3 opacity-50"></i>
                                        <p>ამ თავში ვიდეოები ჯერ არ არის დამატებული</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-12">
                    <div class="w-48 h-48 relative mb-8">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i class="fas fa-book-open text-8xl text-primary-400 opacity-50"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-2">თავები არ არის დამატებული</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-center max-w-md">
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
