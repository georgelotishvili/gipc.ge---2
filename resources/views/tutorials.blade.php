<x-layout>
    <x-workspace-sidebar />
    <div class="min-h-screen bg-gray-200 dark:bg-slate-800 relative overflow-hidden rounded-lg" x-data="{ showAllVideos: false }">
        <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 py-2 sm:py-4 lg:py-6">
            <!-- Revolutionary Header -->
            <div class="text-center mb-4 sm:mb-6 lg:mb-8">
                <div class="relative inline-block">
                    <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-2 sm:mb-3 lg:mb-4 leading-tight">
                        სასწავლო ვიდეოები
                    </h1>
                </div>
                <p class="text-sm sm:text-base md:text-lg lg:text-xl text-gray-600 dark:text-gray-300 max-w-md sm:max-w-2xl lg:max-w-4xl mx-auto leading-relaxed font-light px-4">
                    გაეცანით ჩვენს რევოლუციურ საგანმანათლებლო ვიდეო რესურსებს 
                    არქიტექტურული სერტიფიცირებისთვის
                </p>
            </div>

            <!-- Futuristic Toggle Switch -->
            <div class="flex justify-center mb-4 sm:mb-6 lg:mb-8">
                <div class="relative bg-white/10 dark:bg-black/20 backdrop-blur-xl p-1.5 sm:p-2 rounded-2xl lg:rounded-3xl border border-gray-200/50 dark:border-white/10 shadow-2xl max-w-full">
                    <div class="flex items-center relative z-10">
                        <button 
                            @click="showAllVideos = false" 
                            :class="{'bg-gradient-to-r from-cyan-500 to-purple-500 text-white shadow-lg scale-105': !showAllVideos, 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-white': showAllVideos}"
                            class="px-4 sm:px-6 lg:px-8 py-2.5 sm:py-3 lg:py-4 rounded-xl lg:rounded-2xl font-bold transition-all duration-500 flex items-center gap-2 lg:gap-3 relative overflow-hidden group text-sm lg:text-base"
                        >
                            <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/20 to-purple-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <i class="fas fa-th-large text-base lg:text-lg relative z-10"></i>
                            <span class="relative z-10 whitespace-nowrap">კურსების ჩამონათვალი</span>
                        </button>
                        <button 
                            @click="showAllVideos = true" 
                            :class="{'bg-gradient-to-r from-purple-500 to-pink-500 text-white shadow-lg scale-105': showAllVideos, 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-white': !showAllVideos}"
                            class="px-4 sm:px-6 lg:px-8 py-2.5 sm:py-3 lg:py-4 rounded-xl lg:rounded-2xl font-bold transition-all duration-500 flex items-center gap-2 lg:gap-3 relative overflow-hidden group text-sm lg:text-base"
                        >
                            <div class="absolute inset-0 bg-gradient-to-r from-purple-500/20 to-pink-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <i class="fas fa-play-circle text-base lg:text-lg relative z-10"></i>
                            <span class="relative z-10 whitespace-nowrap">ვიდეოების ჩამონათვალი</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Revolutionary Courses Grid -->
            <div x-show="!showAllVideos" x-transition class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4 lg:gap-6 mb-6 sm:mb-8">
                
                @foreach ($courses as $course)
                <!-- Revolutionary Course Card -->
                    <a href="{{ route('tutorials.chapters', $course->id) }}" class="group bg-white dark:bg-white/8 backdrop-blur-xl rounded-2xl sm:rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-700 border border-gray-100 dark:border-white/15 hover:border-gray-200 dark:hover:border-white/25 h-full flex flex-col relative">
                        <!-- Animated Background Pattern -->
                        <div class="absolute inset-0 opacity-5 group-hover:opacity-10 transition-opacity duration-700">
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 via-purple-500/20 to-indigo-500/20 animate-pulse"></div>
                        </div>

                        <!-- Card Header -->
                        <div class="h-32 sm:h-36 lg:h-40 relative overflow-hidden">
                            @if($course->image()->exists())
                                <img src="https://images.pexels.com/photos/9410062/pexels-photo-9410062.jpeg" alt="{{ $course->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-50 dark:from-white/8 dark:to-white/4 flex items-center justify-center relative">
                                    <div class="absolute inset-0 bg-gradient-to-r from-blue-500/10 via-purple-500/10 to-indigo-500/10 animate-pulse"></div>
                                    <div class="text-center relative z-10">
                                        <div class="w-12 h-12 sm:w-16 sm:h-16 lg:w-20 lg:h-20 bg-gray-200 dark:bg-white/15 backdrop-blur-sm rounded-2xl sm:rounded-3xl flex items-center justify-center mb-2 sm:mb-3 lg:mb-4 group-hover:scale-110 transition-transform duration-700 border border-gray-300 dark:border-white/20 shadow-2xl">
                                            <i class="fas fa-graduation-cap text-lg sm:text-2xl lg:text-3xl text-gray-600 dark:text-white"></i>
                                        </div>
                                        <span class="text-gray-700 dark:text-white/90 font-medium text-xs sm:text-sm lg:text-base">სასწავლო კურსი</span>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Enhanced Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 dark:from-black/90 via-gray-900/30 dark:via-black/30 to-transparent"></div>
                            
                            <!-- Floating Elements -->
                            <div class="absolute top-2 sm:top-4 right-2 sm:right-4 w-1.5 sm:w-2 h-1.5 sm:h-2 bg-blue-400 rounded-full animate-ping opacity-75"></div>
                            <div class="absolute top-4 sm:top-8 right-4 sm:right-8 w-1 h-1 bg-purple-400 rounded-full animate-ping opacity-75" style="animation-delay: 1s;"></div>
                            
                            <!-- Play Button with Glow -->
                            <div class="absolute bottom-3 sm:bottom-5 right-3 sm:right-5">
                                <div class="relative">
                                    <div class="absolute inset-0 bg-blue-500/30 rounded-xl sm:rounded-2xl blur-lg group-hover:bg-purple-500/30 transition-all duration-700"></div>
                                    <div class="w-10 h-10 sm:w-12 sm:h-12 lg:w-14 lg:h-14 bg-black/50 backdrop-blur-sm rounded-xl sm:rounded-2xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-12 transition-all duration-700 border border-white/20 shadow-xl relative">
                                        <i class="fas fa-play text-white text-sm sm:text-base lg:text-xl ml-0.5 sm:ml-1"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Course Title Overlay -->
                            <div class="absolute bottom-0 left-0 right-0 p-3 sm:p-4 lg:p-6">
                                <h3 class="text-sm sm:text-base lg:text-xl font-bold text-white mb-1 sm:mb-2 line-clamp-2 group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-blue-400 group-hover:to-purple-400 transition-all duration-500">
                                    {{ $course->name }}
                                </h3>
                            </div>
                        </div>
                        
                        <!-- Card Content -->
                        <div class="p-2 sm:p-3 lg:p-4 flex-1 flex flex-col relative">
                            <!-- Course Description -->
                            <div class="mb-2 sm:mb-3 flex-1">
                                <p class="text-gray-600 dark:text-gray-300 leading-relaxed line-clamp-2 text-xs sm:text-sm font-light group-hover:text-gray-800 dark:group-hover:text-gray-200 transition-colors duration-500">
                                    {{ $course->description }}
                                </p>
                            </div>
                            
                            <!-- Revolutionary Stats Section -->
                            <div class="mb-2 sm:mb-3">
                                <div class="grid grid-cols-2 gap-2 sm:gap-3">
                                    <div class="bg-gradient-to-br from-gray-50 to-white dark:from-white/8 dark:to-white/4 backdrop-blur-sm rounded-lg sm:rounded-xl p-2 sm:p-3 border border-gray-200 dark:border-white/10 group-hover:bg-gradient-to-br group-hover:from-blue-500/10 group-hover:to-blue-600/10 transition-all duration-500 h-12 sm:h-16 flex items-center relative overflow-hidden">
                                        <div class="absolute inset-0 bg-gradient-to-r from-blue-500/0 via-blue-400/5 to-blue-500/0 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                                        <div class="flex items-center gap-1.5 sm:gap-2.5 w-full relative z-10">
                                            <div class="w-6 h-6 sm:w-8 sm:h-8 bg-blue-500/20 rounded-md sm:rounded-lg flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-500">
                                                <i class="fas fa-video text-blue-400 text-xs sm:text-sm"></i>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <div class="text-gray-900 dark:text-white font-bold text-sm sm:text-base group-hover:text-blue-300 transition-colors duration-300">{{ $course->chapters->sum(function($chapter) { return $chapter->videos->count(); }) }}</div>
                                                <div class="text-gray-500 dark:text-gray-400 text-xs font-medium">ვიდეო</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gradient-to-br from-gray-50 to-white dark:from-white/8 dark:to-white/4 backdrop-blur-sm rounded-lg sm:rounded-xl p-2 sm:p-3 border border-gray-200 dark:border-white/10 group-hover:bg-gradient-to-br group-hover:from-purple-500/10 group-hover:to-purple-600/10 transition-all duration-500 h-12 sm:h-16 flex items-center relative overflow-hidden">
                                        <div class="absolute inset-0 bg-gradient-to-r from-purple-500/0 via-purple-400/5 to-purple-500/0 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                                        <div class="flex items-center gap-1.5 sm:gap-2.5 w-full relative z-10">
                                            <div class="w-6 h-6 sm:w-8 sm:h-8 bg-purple-500/20 rounded-md sm:rounded-lg flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-500">
                                                <i class="fas fa-clock text-purple-400 text-xs sm:text-sm"></i>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                @php
                                                    $totalSeconds = $course->chapters->sum(function($chapter) { return $chapter->videos->sum('duration'); });
                                                    $hours = floor($totalSeconds / 3600);
                                                    $minutes = floor(($totalSeconds % 3600) / 60);
                                                @endphp
                                                <div class="text-gray-900 dark:text-white font-bold text-sm sm:text-base group-hover:text-purple-300 transition-colors duration-300">
                                                    @if($hours > 0)
                                                        {{ $hours }}+ საათი
                                                    @else
                                                        {{ $minutes }} წთ
                                                    @endif
                                                </div>
                                                <div class="text-gray-500 dark:text-gray-400 text-xs font-medium">
                                                    @if($hours > 0)
                                                        ხანგრძლივობა
                                                    @else
                                                        ხანგრძლივობა
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Enhanced Meta Info -->
                            <div class="mb-2 sm:mb-3">
                                <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                                    <span class="flex items-center gap-1 sm:gap-1.5 group-hover:text-gray-700 dark:group-hover:text-gray-300 transition-colors duration-300">
                                        <i class="fas fa-layer-group text-gray-400 dark:text-white/60 group-hover:text-blue-400 transition-colors duration-300"></i>
                                        <span class="hidden sm:inline">{{ $course->chapters->count() }} თავი</span>
                                        <span class="sm:hidden">{{ $course->chapters->count() }}</span>
                                    </span>
                                    <span class="flex items-center gap-1 sm:gap-1.5 group-hover:text-gray-700 dark:group-hover:text-gray-300 transition-colors duration-300">
                                        <i class="fas fa-users text-gray-400 dark:text-white/60 group-hover:text-purple-400 transition-colors duration-300"></i>
                                        <span class="hidden sm:inline">ონლაინ კურსი</span>
                                        <span class="sm:hidden">ონლაინ</span>
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Revolutionary Action Button -->
                            <div class="mt-auto">
                                <button class="w-full px-2 sm:px-3 py-2 sm:py-2.5 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 hover:from-blue-500 hover:via-indigo-500 hover:to-purple-500 text-white rounded-lg sm:rounded-xl transition-all duration-500 text-xs sm:text-sm font-bold group-hover:scale-105 shadow-xl flex items-center justify-center gap-1.5 sm:gap-2 relative overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                                    <span class="relative z-10">დეტალურად</span>
                                    <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 sm:group-hover:translate-x-2 transition-transform duration-500 relative z-10"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Revolutionary Hover Effects -->
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-500/0 via-purple-500/0 to-indigo-500/0 group-hover:from-blue-500/10 group-hover:via-purple-500/10 group-hover:to-indigo-500/10 transition-all duration-700 rounded-2xl sm:rounded-3xl pointer-events-none"></div>
                        
                        <!-- Corner Accent -->
                        <div class="absolute top-0 right-0 w-8 h-8 sm:w-12 sm:h-12 lg:w-16 lg:h-16 bg-gradient-to-br from-blue-500/20 to-purple-500/20 rounded-bl-2xl sm:rounded-bl-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                    </a>
                @endforeach
            </div>

            <!-- Video Grid -->
            <div x-show="showAllVideos" x-cloak x-transition class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-2 gap-3 sm:gap-4 lg:gap-6">
                @foreach ($courses as $course)
                    @foreach ($course->chapters as $chapter)
                        @foreach ($chapter->videos as $video)
                            <livewire:video-card :video="$video" />
                        @endforeach
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        [x-cloak] { display: none !important; }
        
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Revolutionary Particle System */
        .particles-container {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .particle {
            position: absolute;
            width: var(--size);
            height: var(--size);
            background: linear-gradient(45deg, #00d4ff, #7c3aed, #ec4899);
            border-radius: 50%;
            animation: float var(--duration) ease-in-out infinite;
            animation-delay: var(--delay);
            opacity: 0.6;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(100vh) translateX(0) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 0.6;
            }
            90% {
                opacity: 0.6;
            }
            100% {
                transform: translateY(-100px) translateX(100px) rotate(360deg);
                opacity: 0;
            }
        }

        /* Floating Geometric Shapes */
        .floating-shape {
            position: absolute;
            opacity: 0.1;
            animation: float-shape 20s ease-in-out infinite;
        }

        .shape-1 {
            width: 100px;
            height: 100px;
            background: linear-gradient(45deg, #00d4ff, #7c3aed);
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 80px;
            height: 80px;
            background: linear-gradient(45deg, #7c3aed, #ec4899);
            border-radius: 50%;
            top: 20%;
            right: 15%;
            animation-delay: 5s;
        }

        .shape-3 {
            width: 120px;
            height: 120px;
            background: linear-gradient(45deg, #ec4899, #00d4ff);
            border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
            bottom: 20%;
            left: 20%;
            animation-delay: 10s;
        }

        .shape-4 {
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, #00d4ff, #7c3aed);
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            bottom: 10%;
            right: 10%;
            animation-delay: 15s;
        }

        @keyframes float-shape {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            25% {
                transform: translateY(-20px) rotate(90deg);
            }
            50% {
                transform: translateY(-10px) rotate(180deg);
            }
            75% {
                transform: translateY(-30px) rotate(270deg);
            }
        }

        /* 3D Transform Support */
        .perspective-1000 {
            perspective: 1000px;
        }

        .transform-style-preserve-3d {
            transform-style: preserve-3d;
        }

        .rotate-y-12 {
            transform: rotateY(12deg);
        }

        /* Glassmorphism Effects */
        .backdrop-blur-xl {
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
        }

        /* Advanced Hover Effects */
        .group:hover .group-hover\:rotate-y-12 {
            transform: rotateY(12deg);
        }

        .group:hover .group-hover\:scale-110 {
            transform: scale(1.1);
        }

        .group:hover .group-hover\:scale-105 {
            transform: scale(1.05);
        }

        .group:hover .group-hover\:rotate-12 {
            transform: rotate(12deg);
        }

        /* Gradient Text Animation */
        .group:hover .group-hover\:text-transparent {
            color: transparent;
        }

        .group:hover .group-hover\:bg-clip-text {
            -webkit-background-clip: text;
            background-clip: text;
        }

        .group:hover .group-hover\:bg-gradient-to-r {
            background-image: linear-gradient(to right, var(--tw-gradient-stops));
        }

        .group:hover .group-hover\:from-cyan-400 {
            --tw-gradient-from: #22d3ee;
            --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(34, 211, 238, 0));
        }

        .group:hover .group-hover\:to-purple-500 {
            --tw-gradient-to: #8b5cf6;
        }
    </style>
    @endpush
</x-layout>