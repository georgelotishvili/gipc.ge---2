<x-layout>
    <x-workspace-sidebar />
    <div class="min-h-screen bg-white dark:bg-dark relative overflow-hidden pt-16" x-data="{ showAllVideos: false }">
        <div class="relative z-10 container mx-auto px-6 py-16">
            <!-- Header -->
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">
                    სასწავლო <span class="bg-gradient-to-r from-primary-400 to-blue-400 bg-clip-text text-transparent">ვიდეოები</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                    გაეცანით ჩვენს საგანმანათლებლო ვიდეო რესურსებს არქიტექტურული სერტიფიცირებისთვის
                </p>
            </div>
            <!-- Toggle Switch for View Mode -->
            <div class="flex justify-center mb-12">
                <div class="bg-gray-100 dark:bg-gray-800 p-1.5 rounded-full shadow-inner flex items-center">
                    <button 
                        @click="showAllVideos = false" 
                        :class="{'bg-white dark:bg-gray-700 text-primary-600 dark:text-primary-400 shadow-md': !showAllVideos, 'text-gray-600 dark:text-gray-300': showAllVideos}"
                        class="px-5 py-2.5 rounded-full font-medium transition-all duration-300 flex items-center gap-2"
                    >
                        <i class="fas fa-th-large"></i>
                        <span>კურსების ჩამონათვალი</span>
                    </button>
                    <button 
                        @click="showAllVideos = true" 
                        :class="{'bg-white dark:bg-gray-700 text-primary-600 dark:text-primary-400 shadow-md': showAllVideos, 'text-gray-600 dark:text-gray-300': !showAllVideos}"
                        class="px-5 py-2.5 rounded-full font-medium transition-all duration-300 flex items-center gap-2"
                    >
                        <i class="fas fa-play-circle"></i>
                        <span>ვიდეოების ჩამონათვალი</span>
                    </button>
                </div>
            </div>

            <!-- Courses Grid (Default View) -->
            <div x-show="!showAllVideos" x-transition class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                
                @foreach ($courses as $course)
                <!-- Course Card 1 -->
                    <a href="{{ route('tutorials.chapters', $course->id) }}" class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700 group">
                        <div class="h-48 relative overflow-hidden {{ $course->image()->exists() ? '' : 'bg-gradient-to-r from-primary-500 to-blue-500' }}">
                            @if($course->image()->exists())
                                <img src="{{ Storage::url($course->image()->first()->path) }}" alt="{{ $course->name }}" class="w-full h-full object-cover brightness-75">
                            @endif
                            <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-all duration-300"></div>
                            <div class="absolute bottom-0 left-0 w-full p-6">
                                <h3 class="text-white text-xl font-bold mb-1 group-hover:translate-x-1 transition-transform duration-300">{{ $course->name }}</h3>
                                <div class="flex items-center text-white/80 text-sm">
                                    <span class="flex items-center gap-1.5">
                                        <i class="fas fa-video"></i>
                                        {{ $course->chapters->sum(function($chapter) { return $chapter->videos->count(); }) }} ვიდეო
                                    </span>
                                    <span class="mx-2">•</span>
                                    <span class="flex items-center gap-1.5">
                                        <i class="fas fa-clock"></i>
                                        @php
                                            $totalSeconds = $course->chapters->sum(function($chapter) { return $chapter->videos->sum('duration'); });
                                            $hours = floor($totalSeconds / 3600);
                                            $minutes = floor(($totalSeconds % 3600) / 60);
                                            $seconds = $totalSeconds % 60;
                                            $formattedTime = sprintf('%d:%02d:%02d', $hours, $minutes, $seconds);
                                        @endphp
                                        {{ $formattedTime }} წთ
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 dark:text-gray-300 mb-4">{{ $course->description }}</p>
                            <div class="flex justify-between items-center">
                                {{-- <span class="inline-flex items-center gap-1 text-sm font-medium text-primary-600 dark:text-primary-400">
                                    <i class="fas fa-users"></i>
                                    245 სტუდენტი
                                </span> --}}
                                <button class="px-4 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-primary-50 dark:hover:bg-gray-600 text-gray-800 dark:text-white rounded-lg transition-colors duration-300 text-sm font-medium">
                                    დეტალურად
                                </button>
                            </div>
                        </div>
                    </a>
                @endforeach

                
            </div>

            <!-- Video Grid -->
            <div x-show="showAllVideos" x-cloak x-transition class="flex flex-wrap gap-8 justify-center">
                <!-- Video Card -->
                @foreach ($courses as $course)
                    @foreach ($course->chapters as $chapter)
                        @foreach ($chapter->videos as $video)
                            <a href="{{ route('tutorials.show', $video->id) }}" class="group w-full md:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.5rem)] flex-shrink-0">
                                <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 h-full flex flex-col">
                                    <div class="aspect-video relative">
                                        @if($video->imageUrl())
                                            <img src="{{ $video->imageUrl() }}" alt="{{ $video->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                                <i class="fas fa-video text-gray-400 text-3xl"></i>
                                            </div>
                                        @endif
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300">
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <span class="w-14 h-14 rounded-full bg-white/90 flex items-center justify-center transform group-hover:scale-105 transition-transform duration-300">
                                                    <i class="fas fa-play text-gray-900 text-xl ml-1"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="absolute bottom-3 right-3 bg-black/80 text-white px-2.5 py-1 rounded-md text-sm font-medium">
                                            @php
                                                $hours = floor($video->duration / 3600);
                                                $minutes = floor(($video->duration % 3600) / 60);
                                                $seconds = $video->duration % 60;
                                                $formattedTime = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
                                            @endphp
                                            {{ $formattedTime }}
                                        </div>
                                    </div>
                                    <div class="p-5 flex flex-col flex-grow">
                                        <div class="flex-grow">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 group-hover:text-primary-500 transition-colors line-clamp-2">
                                                {{ $video->name }}
                                            </h3>
                                            <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-2">
                                                {{ $video->description }}
                                            </p>
                                        </div>
                                        <div class="flex items-center gap-4 text-sm text-gray-500 dark:text-gray-400 mt-4">
                                            <span class="inline-flex items-center gap-1.5">
                                                <i class="far fa-calendar text-gray-400"></i>
                                                {{ $video->created_at->format('d F, Y') }}
                                            </span>
                                            <span class="inline-flex items-center gap-1.5">
                                                <i class="far fa-eye text-gray-400"></i>
                                                {{ $video->views }} ნახვა
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @endforeach
                @endforeach
            </div>
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