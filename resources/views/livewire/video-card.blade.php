@if($style === 'grid')
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
                    {{ $this->getFormattedDuration() }}
                </div>
                @auth
                    @if(auth()->user()->is_admin)
                        <div class="absolute top-3 right-3 bg-black/80 px-2.5 py-1 rounded-md">
                            <div class="flex items-center gap-2">
                                <label for="weight-{{ $video->id }}" class="text-sm text-white">რიგი:</label>
                                <input 
                                    type="number" 
                                    id="weight-{{ $video->id }}" 
                                    wire:model="weight" 
                                    wire:change="updateWeight"
                                    class="w-20 text-sm border border-gray-300 dark:border-gray-600 rounded px-2 py-1 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 bg-white/90"
                                    step="any"
                                    min="0"
                                >
                            </div>
                        </div>
                    @endif
                @endauth
            </div>
            <div class="p-5 flex flex-col flex-grow">
                <div class="flex-grow">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 group-hover:text-primary-500 transition-colors line-clamp-2">
                        {{ $video->title }}
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
@else
    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 flex items-center hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200">
        <div class="w-32 h-20 relative bg-gray-200 dark:bg-gray-600 rounded-md flex-shrink-0 mr-4 overflow-hidden">
            @if($video->imageUrl())
                <img src="{{ $video->imageUrl() }}" alt="{{ $video->name }}" class="absolute inset-0 w-full h-full object-cover">
            @else
                <div class="absolute inset-0 flex items-center justify-center">
                    <i class="fas fa-play-circle text-gray-400 text-3xl"></i>
                </div>
            @endif
            <div class="absolute bottom-1 right-1 bg-black/70 text-white text-xs px-1.5 py-0.5 rounded">
                {{ $this->getFormattedDuration() }}
            </div>
            @auth
                @if(auth()->user()->is_admin)
                    <div class="absolute top-1 right-1 bg-black/80 px-1.5 py-0.5 rounded">
                        <div class="flex items-center gap-2">
                            <label for="weight-list-{{ $video->id }}" class="text-xs text-white">რიგი:</label>
                            <input 
                                type="number" 
                                id="weight-list-{{ $video->id }}" 
                                wire:model="weight" 
                                wire:change="updateWeight"
                                class="w-16 text-xs border border-gray-300 dark:border-gray-600 rounded px-1 py-0.5 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 bg-white/90"
                                step="any"
                                min="0"
                            >
                        </div>
                    </div>
                @endif
            @endauth
        </div>
        
        <div class="flex-grow">
            <h3 class="font-medium text-gray-900 dark:text-white">{{ $video->title }}</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-1">{{ $video->description }}</p>
        </div>
        
        <a href="{{ route('tutorials.show', $video->id) }}" class="ml-4 p-2 bg-primary-500 hover:bg-primary-600 text-white rounded-full flex-shrink-0 transition-colors duration-200">
            <i class="fas fa-play"></i>
        </a>
    </div>
@endif