@if($style === 'grid')
    @if(!$this->isLocked)
    <a href="{{ route('tutorials.show', $video->id) }}" class="group w-full flex-shrink-0">
    @else
    <div class="group w-full flex-shrink-0 cursor-not-allowed" title="Not allowed">
    @endif
        <div class="relative bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-700 h-full flex flex-col border border-gray-200 dark:border-gray-700 transform hover:-translate-y-1 hover:scale-[1.01]">
            <!-- Animated Background -->
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 via-purple-500/5 to-pink-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
            
            <!-- Corner Accent -->
            <div class="absolute top-0 right-0 w-12 h-12 bg-gradient-to-bl from-blue-500/20 to-transparent rounded-bl-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
            
            <div class="aspect-video relative overflow-hidden">
                @if($video->imageUrl())
                    <img src="{{ $video->imageUrl() }}" alt="{{ $video->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                @else
                    <div class="w-full h-full bg-gradient-to-br from-gray-100 via-blue-50 to-purple-50 dark:from-gray-700 dark:via-blue-900/20 dark:to-purple-900/20 flex items-center justify-center">
                        <i class="fas fa-video text-gray-400 text-3xl group-hover:scale-110 transition-transform duration-500"></i>
                    </div>
                @endif
                
                <!-- Enhanced Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-700">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="relative">
                            <div class="w-12 h-12 rounded-full bg-white/95 flex items-center justify-center transform group-hover:scale-110 transition-transform duration-500 shadow-2xl">
                                <i class="fas fa-play text-gray-900 text-lg ml-1"></i>
                            </div>
                            <!-- Ripple Effect -->
                            <div class="absolute inset-0 rounded-full bg-white/30 animate-ping group-hover:animate-none"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Duration Badge -->
                <div class="absolute bottom-2 right-2 bg-black/90 backdrop-blur-sm text-white px-2 py-1 rounded-lg text-xs font-bold border border-white/20 group-hover:bg-blue-600 transition-colors duration-500">
                    {{ $this->getFormattedDuration() }}
                </div>
                @if($this->isLocked)
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <span class="text-white text-xs font-semibold px-2 py-1 bg-black/70 rounded"><i class="fas fa-lock mr-1"></i> Not allowed</span>
                    </div>
                @endif
                @auth
                    @if(auth()->user()->is_admin)
                        <div class="absolute top-2 right-2 bg-black/90 backdrop-blur-sm px-2 py-1 rounded-lg border border-white/20">
                            <div class="flex items-center gap-1">
                                <label for="weight-{{ $video->id }}" class="text-xs text-white font-medium">რიგი:</label>
                                <input 
                                    type="number" 
                                    id="weight-{{ $video->id }}" 
                                    wire:model="weight" 
                                    wire:change="updateWeight"
                                    class="w-24 sm:w-28 text-xs border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 text-black dark:text-white rounded-md shadow-sm"
                                    step="any"
                                    min="0"
                                >
                            </div>
                        </div>
                    @endif
                @endauth
            </div>
            <div class="p-3 flex flex-col flex-grow relative">
                <div class="flex-grow">
                    <h3 class="text-sm font-bold text-gray-900 dark:text-white mb-1 group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-blue-600 group-hover:to-purple-600 transition-all duration-500 line-clamp-2 leading-tight">
                        {{ $video->title }}
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 text-xs line-clamp-2 leading-relaxed group-hover:text-gray-700 dark:group-hover:text-gray-200 transition-colors duration-500">
                        {{ $video->description }}
                    </p>
                </div>
                <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400 mt-2 pt-2 border-t border-gray-100 dark:border-gray-700">
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center gap-1">
                            <i class="far fa-eye text-gray-400 group-hover:text-purple-500 transition-colors duration-500"></i>
                            <span class="font-medium">{{ $video->views }}</span>
                        </span>
                    </div>
                    <div class="flex items-center gap-1 px-2 py-1 bg-gradient-to-r from-blue-50 to-purple-50 dark:from-blue-900/20 dark:to-purple-900/20 rounded-lg group-hover:from-blue-100 group-hover:to-purple-100 dark:group-hover:from-blue-800/30 dark:group-hover:to-purple-800/30 transition-all duration-500">
                        <i class="fas fa-clock text-blue-500 group-hover:text-purple-500 transition-colors duration-500"></i>
                        <span class="font-medium text-blue-600 dark:text-blue-400 group-hover:text-purple-600 dark:group-hover:text-purple-400">{{ $this->getFormattedDuration() }}</span>
                    </div>
                </div>
            </div>
        </div>
    @if(!$this->isLocked)
    </a>
    @else
    </div>
    @endif
@else
    <div class="group relative bg-white dark:bg-gray-800 rounded-lg sm:rounded-xl p-2 sm:p-4 flex flex-col sm:flex-row sm:items-center hover:bg-gradient-to-r hover:from-gray-50 hover:to-blue-50 dark:hover:from-gray-700 dark:hover:to-blue-900/20 transition-all duration-500 border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
        <!-- Animated Background -->
        <div class="absolute inset-0 bg-gradient-to-r from-blue-500/5 via-purple-500/5 to-pink-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-xl"></div>
        
        <div class="w-full sm:w-40 h-24 sm:h-32 relative bg-gradient-to-br from-gray-100 via-blue-50 to-purple-50 dark:from-gray-700 dark:via-blue-900/20 dark:to-purple-900/20 rounded-md sm:rounded-xl flex-shrink-0 mb-2 sm:mb-0 sm:mr-4 overflow-hidden group-hover:scale-105 transition-transform duration-500">
            @if($video->imageUrl())
                <img src="{{ $video->imageUrl() }}" alt="{{ $video->name }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            @else
                <div class="absolute inset-0 flex items-center justify-center">
                    <i class="fas fa-play-circle text-gray-400 text-4xl group-hover:scale-110 transition-transform duration-500"></i>
                </div>
            @endif
            <div class="absolute bottom-2 sm:bottom-3 right-2 sm:right-3 bg-black/90 backdrop-blur-sm text-white text-xs sm:text-sm px-2 sm:px-3 py-1 sm:py-1.5 rounded-md sm:rounded-lg font-bold border border-white/20 group-hover:bg-blue-600 transition-colors duration-500">
                {{ $this->getFormattedDuration() }}
            </div>
            @if($this->isLocked)
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <span class="text-white text-[10px] px-2 py-0.5 bg-black/70 rounded"><i class="fas fa-lock mr-1"></i> Not allowed</span>
                </div>
            @endif
            @auth
                                    @if(auth()->user()->is_admin)
                        <div class="absolute top-2 sm:top-3 right-2 sm:right-3 bg-black/90 backdrop-blur-sm px-2 sm:px-3 py-1 sm:py-1.5 rounded-md sm:rounded-lg border border-white/20">
                            <div class="flex items-center gap-1">
                                <label for="weight-list-{{ $video->id }}" class="text-xs text-white font-medium">რიგი:</label>
                                <input 
                                    type="number" 
                                    id="weight-list-{{ $video->id }}" 
                                    wire:model="weight" 
                                    wire:change="updateWeight"
                                    class="w-24 sm:w-28 text-xs border border-gray-300 dark:border-gray-600 rounded px-1 py-0.5 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 bg-white/95 dark:bg-gray-800 
                                    text-black dark:text-white"
                                    step="any"
                                    min="0"
                                >
                            </div>
                        </div>
                    @endif
            @endauth
        </div>
        
        <div class="flex-grow min-w-0">
            <h3 class="font-bold text-gray-900 dark:text-white text-sm sm:text-base mb-1 group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-blue-600 group-hover:to-purple-600 transition-all duration-500 truncate">{{ $video->title }}</h3>
            <p class="text-gray-600 dark:text-gray-300 text-xs line-clamp-1 mb-2 sm:mb-3 group-hover:text-gray-700 dark:group-hover:text-gray-200 transition-colors duration-500">{{ $video->description }}</p>
            <div class="flex flex-wrap items-center gap-1 sm:gap-2 text-xs text-gray-500 dark:text-gray-400">
                <span class="inline-flex items-center gap-1 sm:gap-2 px-2 sm:px-3 py-1 sm:py-1.5 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 rounded-md sm:rounded-lg group-hover:from-blue-50 group-hover:to-purple-50 dark:group-hover:from-blue-900/20 dark:group-hover:to-purple-900/20 transition-all duration-500">
                    <i class="far fa-calendar text-gray-400 group-hover:text-blue-500 transition-colors duration-500"></i>
                    <span class="font-bold text-xs sm:text-sm">{{ $video->created_at->format('d F, Y') }}</span>
                </span>
                <span class="inline-flex items-center gap-1 sm:gap-2 px-2 sm:px-3 py-1 sm:py-1.5 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 rounded-md sm:rounded-lg group-hover:from-blue-50 group-hover:to-purple-50 dark:group-hover:from-blue-900/20 dark:group-hover:to-purple-900/20 transition-all duration-500">
                    <i class="far fa-eye text-gray-400 group-hover:text-purple-500 transition-colors duration-500"></i>
                    <span class="font-bold text-xs sm:text-sm">{{ $video->views }} ნახვა</span>
                </span>
            </div>
        </div>
        
        @if(!$this->isLocked)
            <a href="{{ route('tutorials.show', $video->id) }}" class="mt-2 sm:mt-0 sm:ml-3 relative self-center sm:self-auto">
                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 hover:from-blue-600 hover:via-purple-600 hover:to-pink-600 text-white rounded-lg sm:rounded-xl flex items-center justify-center flex-shrink-0 transition-all duration-500 transform group-hover:scale-105 shadow-md sm:shadow-lg">
                    <i class="fas fa-play text-xs"></i>
                </div>
                <!-- Ripple Effect -->
                <div class="absolute inset-0 rounded-lg sm:rounded-xl bg-gradient-to-r from-blue-500/30 via-purple-500/30 to-pink-500/30 animate-ping group-hover:animate-none"></div>
            </a>
        @else
            <div class="mt-2 sm:mt-0 sm:ml-3 relative self-center sm:self-auto cursor-not-allowed" title="Not allowed">
                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gray-300 dark:bg-gray-600 text-white rounded-lg sm:rounded-xl flex items-center justify-center flex-shrink-0 shadow-md sm:shadow-lg">
                    <i class="fas fa-lock text-xs"></i>
                </div>
            </div>
        @endif
    </div>
@endif