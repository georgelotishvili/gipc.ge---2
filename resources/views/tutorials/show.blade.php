<x-layout>
    @php
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://video.bunnycdn.com/library/382670/videos/'.$video->video_id, [
        'headers' => [
            'AccessKey' => config('video.api_key'),
            'accept' => 'application/json',
        ],
        ]);

        // Convert the response body to a JSON object
        $responseData = json_decode($response->getBody(), true);
    @endphp
    
    <div class="min-h-screen bg-white dark:bg-slate-900">
        <div class="flex flex-col lg:flex-row">
            <!-- Main Content Area -->
            <div class="flex-1 lg:pr-0">
                <!-- Video Player Section -->
                <div class="bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700">
                    <div class="max-w-7xl mx-auto">
                        <!-- Video Player -->
                        <div class="w-full relative">
                            


                            <div id="video-container" style="position:relative;padding-top:56.25%;" class="rounded-2xl overflow-hidden shadow-2xl mx-4 mt-4 transition-all duration-500">
                                <iframe 
                                    id="video-player"
                                    src="https://iframe.mediadelivery.net/embed/{{$video->library_id}}/{{$video->video_id}}?autoplay=true&loop=false&muted=false&preload=true&responsive=true" 
                                    loading="lazy" 
                                    style="border:0;position:absolute;top:0;height:100%;width:100%;" 
                                    allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture;" 
                                    allowfullscreen="true"
                                    class="rounded-2xl">
                                </iframe>
                            </div>
                        </div>

                        <!-- Video Info -->
                        <div class="p-6 sm:p-8 lg:p-10">
                            <div class="max-w-5xl">
                                <!-- Title and Actions Row -->
                                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4 mb-6">
                                    <div class="flex-1">
                                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-900 dark:text-white mb-2 leading-tight">{{ $video->title }}</h1>
                                        <!-- Course Breadcrumb -->
                                        <nav class="hidden md:flex items-center space-x-2 text-sm text-slate-500 dark:text-slate-400 mb-4">
                                            <a href="{{ route('tutorials') }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">კურსები</a>
                                            <i class="fas fa-chevron-right text-xs"></i>
                                            <a href="{{ route('tutorials.chapters', $course->id) }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">{{ $course->name }}</a>
                                            <i class="fas fa-chevron-right text-xs"></i>
                                            <span class="text-slate-700 dark:text-slate-300 font-medium">{{ $chapter->name }}</span>
                                        </nav>
                                    </div>
                                    
                                    <!-- Action Buttons -->
                                    <div class="flex items-center gap-3">
                                        <button onclick="toggleBookmark()" class="flex items-center gap-2 px-4 py-2 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-xl transition-all duration-200 hover:scale-105">
                                            <i id="bookmark-icon" class="far fa-bookmark text-slate-600 dark:text-slate-400"></i>
                                            <span class="hidden sm:inline text-sm font-medium text-slate-700 dark:text-slate-300">შენახვა</span>
                                        </button>
                                        <button onclick="shareVideo()" class="flex items-center gap-2 px-4 py-2 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-xl transition-all duration-200 hover:scale-105">
                                            <i class="fas fa-share text-slate-600 dark:text-slate-400"></i>
                                            <span class="hidden sm:inline text-sm font-medium text-slate-700 dark:text-slate-300">გაზიარება</span>
                                        </button>
                                    </div>
                                </div>

                                <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 mb-8 leading-relaxed max-w-4xl">{{ $video->description }}</p>
                                
                                <!-- Enhanced Video Stats -->
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-3 md:gap-4 mb-6 md:mb-8">
                                    <!-- Views -->
                                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 p-3 md:p-4 rounded-xl border border-blue-200 dark:border-blue-700">
                                        <div class="flex items-center gap-2 md:gap-3">
                                            <div class="w-8 h-8 md:w-10 md:h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                                                <i class="far fa-eye text-white text-sm md:text-base"></i>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <p class="text-lg md:text-2xl font-bold text-blue-700 dark:text-blue-300 truncate">{{ $responseData['views'] ?? 0 }}</p>
                                                <p class="hidden md:block text-xs text-blue-600 dark:text-blue-400 font-medium">ნახვა</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Duration -->
                                    <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 dark:from-emerald-900/20 dark:to-emerald-800/20 p-3 md:p-4 rounded-xl border border-emerald-200 dark:border-emerald-700">
                                        <div class="flex items-center gap-2 md:gap-3">
                                            <div class="w-8 h-8 md:w-10 md:h-10 bg-emerald-500 rounded-lg flex items-center justify-center">
                                                <i class="far fa-clock text-white text-sm md:text-base"></i>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <p class="text-lg md:text-2xl font-bold text-emerald-700 dark:text-emerald-300 truncate">{{ isset($video->duration) ? sprintf('%02d:%02d', floor($video->duration/60), $video->duration%60) : '00:00' }}</p>
                                                <p class="hidden md:block text-xs text-emerald-600 dark:text-emerald-400 font-medium">ხანგრძლივობა</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Published Date -->
                                    <div class="col-span-2 md:col-span-1 bg-gradient-to-br from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/20 p-3 md:p-4 rounded-xl border border-orange-200 dark:border-orange-700">
                                        <div class="flex items-center gap-2 md:gap-3">
                                            <div class="w-8 h-8 md:w-10 md:h-10 bg-orange-500 rounded-lg flex items-center justify-center">
                                                <i class="far fa-calendar text-white text-sm md:text-base"></i>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <p class="text-sm md:text-base font-bold text-orange-700 dark:text-orange-300 truncate">{{ $video->created_at->format('M d') }}</p>
                                                <p class="hidden md:block text-xs text-orange-600 dark:text-orange-400 font-medium">გამოქვეყნდა</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Navigation Buttons -->
                                <div class="flex flex-wrap items-center gap-4 sm:gap-6">
                                    @if($previousVideo)
                                        @php $prevLocked = !Auth::user()->hasActiveSubscription() && !$previousVideo?->free; @endphp
                                        <a href="{{ $prevLocked ? '#' : route('tutorials.show', $previousVideo->id) }}" 
                                           class="group inline-flex items-center gap-3 px-6 sm:px-8 py-4 {{ $prevLocked ? 'bg-slate-200 dark:bg-slate-700/60 text-slate-400 cursor-not-allowed' : 'bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-600' }} rounded-2xl transition-all duration-300 text-sm font-semibold shadow-lg hover:shadow-xl transform {{ $prevLocked ? '' : 'hover:-translate-y-1' }}"
                                           {{ $prevLocked ? 'aria-disabled=true' : '' }}>
                                            <i class="fas fa-chevron-left text-sm group-hover:-translate-x-1 transition-transform"></i>
                                            <span class="hidden sm:inline">წინა ვიდეო</span>
                                            @if($prevLocked)
                                                <i class="fas fa-lock ml-2 text-xs"></i>
                                            @endif
                                            <span class="sm:hidden">წინა</span>
                                        </a>
                                    @endif
                                    
                                    @if($nextVideo)
                                        @php $nextLocked = !Auth::user()->hasActiveSubscription() && !$nextVideo?->free; @endphp
                                        <a href="{{ $nextLocked ? '#' : route('tutorials.show', $nextVideo->id) }}" 
                                           id="next-video-btn"
                                           class="group inline-flex items-center gap-3 px-6 sm:px-8 py-4 {{ $nextLocked ? 'bg-blue-300 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700' }} text-white rounded-2xl transition-all duration-300 text-sm font-semibold shadow-lg hover:shadow-xl transform {{ $nextLocked ? '' : 'hover:-translate-y-1' }}"
                                           {{ $nextLocked ? 'aria-disabled=true' : '' }}>
                                            <span class="hidden sm:inline">შემდეგი ვიდეო</span>
                                            <span class="sm:hidden">შემდეგი</span>
                                            <i class="fas fa-chevron-right text-sm group-hover:translate-x-1 transition-transform"></i>
                                            @if($nextLocked)
                                                <i class="fas fa-lock ml-2 text-xs"></i>
                                            @endif
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Info Section -->
                <div class="max-w-7xl mx-auto p-6 sm:p-8 lg:p-10">
                    <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 sm:p-10 shadow-2xl border border-slate-200 dark:border-slate-700">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center shadow-xl">
                                <i class="fas fa-book-open text-white text-xl"></i>
                            </div>
                            <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-white">{{ $chapter->name }}</h2>
                        </div>
                        <p class="text-lg sm:text-xl text-slate-600 dark:text-slate-300 leading-relaxed max-w-4xl">{{ $chapter->description }}</p>
                    </div>
                </div>
            </div>

            <!-- Mobile Playlist Toggle Button -->
            <div class="lg:hidden fixed bottom-4 right-4 z-50">
                <button onclick="toggleMobilePlaylist()" class="w-14 h-14 bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-lg flex items-center justify-center transition-all duration-300 hover:scale-110">
                    <i id="mobile-playlist-icon" class="fas fa-list text-xl"></i>
                </button>
            </div>

            <!-- Mobile Playlist Overlay -->
            <div id="mobile-playlist-overlay" class="lg:hidden fixed inset-0 bg-black bg-opacity-50 z-40 hidden">
                <div class="absolute inset-0" onclick="toggleMobilePlaylist()"></div>
            </div>

            <!-- Playlist Sidebar -->
            <div id="playlist-sidebar" class="w-full lg:w-80 bg-white dark:bg-slate-800 border-t lg:border-l lg:border-t-0 border-slate-200 dark:border-slate-700 lg:h-screen flex flex-col shadow-xl lg:relative fixed top-0 left-0 h-full z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 overflow-hidden">
                <!-- Header - Fixed -->
                <div class="flex-shrink-0 p-4 border-b border-slate-200 dark:border-slate-700">
                    <!-- Mobile Header -->
                    <div class="lg:hidden flex items-center justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <button onclick="toggleMobilePlaylist()" class="w-8 h-8 bg-slate-100 dark:bg-slate-700 rounded-lg flex items-center justify-center hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors">
                                <i class="fas fa-times text-slate-600 dark:text-slate-400"></i>
                            </button>
                            <h3 class="text-base font-bold text-slate-900 dark:text-white">{{ $chapter->name }}</h3>
                        </div>
                        <span class="px-3 py-1 bg-blue-600 text-white rounded-full text-xs font-semibold">{{ count($playlist) }} ვიდეო</span>
                    </div>
                    
                    <!-- Desktop Header -->
                    <div class="hidden lg:block mb-3">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-lg">
                                <i class="fas fa-list text-white text-sm"></i>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white">{{ $chapter->name }}</h3>
                        </div>
                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ count($playlist) }} ვიდეო playlist-ში</p>
                    </div>
                    
                    <!-- Search and Controls -->
                    <div class="space-y-3">
                        <!-- Search Bar -->
                        <div class="relative">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400 text-sm"></i>
                            <input type="text" 
                                   id="playlist-search" 
                                   placeholder="ვიდეოს ძებნა..." 
                                   class="w-full pl-10 pr-4 py-2 bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            <button onclick="clearSearch()" id="clear-search" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-slate-400 hover:text-slate-600 hidden">
                                <i class="fas fa-times text-xs"></i>
                            </button>
                        </div>
                        
                        <!-- Video Counter -->
                        <div class="flex items-center justify-end">
                            <div class="text-xs text-slate-500 dark:text-slate-400">
                                <span id="current-video-index">{{ array_search($video->id, array_column($playlist->toArray(), 'id')) + 1 }}</span> / {{ count($playlist) }}
                            </div>
                        </div>
                        

                    </div>
                </div>
                
                <!-- Playlist - Scrollable -->
                <div class="flex-1 overflow-y-auto scrollbar-thin scrollbar-thumb-slate-300 scrollbar-track-slate-100 dark:scrollbar-thumb-slate-600 dark:scrollbar-track-slate-700">
                    <div class="p-4 space-y-3">
                        @foreach($playlist as $index => $playlistVideo)
                            @php $locked = !Auth::user()->hasActiveSubscription() && !$playlistVideo->free; @endphp
                            <a href="{{ $locked ? '#' : route('tutorials.show', $playlistVideo->id) }}" 
                               class="group block rounded-xl border transition-all duration-300 {{ $locked ? 'opacity-60 cursor-not-allowed' : 'hover:shadow-xl hover:-translate-y-1' }} {{ $playlistVideo->id === $video->id ? 'bg-blue-50 dark:bg-blue-900/20 border-blue-300 dark:border-blue-600 shadow-lg dark:shadow-md' : 'bg-white dark:bg-slate-700 border-slate-200 dark:border-slate-600 hover:bg-slate-50 dark:hover:bg-slate-600 hover:border-slate-300 dark:hover:border-slate-500 shadow-md dark:shadow-sm' }}"
                               data-video-title="{{ strtolower($playlistVideo->title) }}"
                               {{ $locked ? 'aria-disabled=true' : '' }}>
                                
                                <!-- Thumbnail Section -->
                                <div class="relative overflow-hidden rounded-t-xl bg-slate-100 dark:bg-slate-600">
                                    <img src="{{ $playlistVideo->imageUrl() }}" 
                                         alt="{{ $playlistVideo->title }}" 
                                         class="w-full h-20 object-cover group-hover:scale-105 transition-transform duration-300"
                                         onerror="this.onerror=null; this.src='https://images.pexels.com/photos/1181244/pexels-photo-1181244.jpeg?auto=compress&cs=tinysrgb&w=400&h=200&fit=crop';"
                                         loading="lazy">
                                    
                                    <!-- Duration Badge -->
                                    <div class="absolute bottom-2 right-2 bg-black bg-opacity-75 text-white text-xs px-2 py-1 rounded-md font-medium">
                                        {{ isset($playlistVideo->duration) ? sprintf('%02d:%02d', floor($playlistVideo->duration/60), $playlistVideo->duration%60) : '00:00' }}
                                    </div>
                                    
                                    <!-- Video Number Badge -->
                                    <div class="absolute top-2 left-2 w-6 h-6 rounded-lg {{ $playlistVideo->id === $video->id ? 'bg-blue-600 text-white' : 'bg-white bg-opacity-90 text-slate-700' }} flex items-center justify-center text-xs font-bold shadow-lg">
                                        {{ $index + 1 }}
                                    </div>
                                    @if($locked)
                                        <div class="absolute top-2 right-2 w-6 h-6 rounded-full bg-black bg-opacity-60 text-white flex items-center justify-center text-xs">
                                            <i class="fas fa-lock"></i>
                                        </div>
                                    @endif
                                    
                                    <!-- Play Button Overlay -->
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                                        <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-lg opacity-0 group-hover:opacity-100 transition-all duration-300 transform scale-75 group-hover:scale-100">
                                            <i class="fas fa-play text-slate-700 text-sm ml-0.5"></i>
                                        </div>
                                    </div>
                                    
                                    <!-- Current Video Indicator -->
                                    @if($playlistVideo->id === $video->id)
                                        <div class="absolute inset-0 bg-blue-600 bg-opacity-20 flex items-center justify-center">
                                            <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center shadow-lg animate-pulse">
                                                <i class="fas fa-play text-white text-sm"></i>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Content Section -->
                                <div class="p-3">
                                    <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-2 line-clamp-2 leading-tight {{ $playlistVideo->id === $video->id ? 'text-blue-700 dark:text-blue-300' : 'group-hover:text-blue-600 dark:group-hover:text-blue-400' }} transition-colors">
                                        {{ $playlistVideo->title }}
                                    </h4>
                                    
                                    <div class="flex items-center justify-between">
                                        @if($playlistVideo->id === $video->id)
                                            <span class="flex items-center gap-2 px-2 py-1 bg-blue-600 text-white rounded-full text-xs font-semibold">
                                                <i class="fas fa-play text-xs"></i>
                                                მიმდინარე
                                            </span>
                                        @else
                                            <div class="flex items-center gap-2">
                                                <span class="text-xs text-slate-500 dark:text-slate-400 font-medium">
                                                    ვიდეო {{ $index + 1 }}
                                                </span>
                                                @if($locked)
                                                    <span class="inline-flex items-center gap-1 text-[10px] px-2 py-0.5 rounded-full bg-slate-200 dark:bg-slate-600 text-slate-600 dark:text-slate-300">
                                                        <i class="fas fa-lock"></i>
                                                        დაიბლოკა
                                                    </span>
                                                @else
                                                    <!-- Watched indicator -->
                                                    <div class="w-2 h-2 rounded-full bg-slate-300 dark:bg-slate-600"></div>
                                                @endif
                                            </div>
                                        @endif
                                        

                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        #auto-play-notification {
            transition: all 0.3s ease;
        }
        .scale-102 {
            transform: scale(1.02);
        }
        .scale-105 {
            transform: scale(1.05);
        }
        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: .5;
            }
        }
        .backdrop-blur-sm {
            backdrop-filter: blur(4px);
        }
        .bg-clip-text {
            -webkit-background-clip: text;
            background-clip: text;
        }
        .text-transparent {
            color: transparent;
        }
        
        /* Custom Scrollbar Styles */
        .scrollbar-thin::-webkit-scrollbar {
            width: 6px;
        }
        .scrollbar-thin::-webkit-scrollbar-track {
            background: rgb(241 245 249);
            border-radius: 3px;
        }
        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: rgb(203 213 225);
            border-radius: 3px;
        }
        .scrollbar-thin::-webkit-scrollbar-thumb:hover {
            background: rgb(148 163 184);
        }
        
        .dark .scrollbar-thin::-webkit-scrollbar-track {
            background: rgb(51 65 85);
        }
        .dark .scrollbar-thin::-webkit-scrollbar-thumb {
            background: rgb(71 85 105);
        }
        .dark .scrollbar-thin::-webkit-scrollbar-thumb:hover {
            background: rgb(100 116 139);
        }
        
        /* Firefox scrollbar */
        .scrollbar-thin {
            scrollbar-width: thin;
            scrollbar-color: rgb(203 213 225) rgb(241 245 249);
        }
        .dark .scrollbar-thin {
            scrollbar-color: rgb(71 85 105) rgb(51 65 85);
        }
    </style>
    @endpush

    @push('scripts')
    <script>
    // Global variables
    let theaterMode = false;
    
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize features
        setupPlaylistSearch();
        setupKeyboardShortcuts();
    });

    // Mobile Playlist Toggle
    function toggleMobilePlaylist() {
        const sidebar = document.getElementById('playlist-sidebar');
        const overlay = document.getElementById('mobile-playlist-overlay');
        const icon = document.getElementById('mobile-playlist-icon');
        
        if (sidebar.classList.contains('-translate-x-full')) {
            // Open sidebar
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            icon.classList.remove('fa-list');
            icon.classList.add('fa-times');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        } else {
            // Close sidebar
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            icon.classList.remove('fa-times');
            icon.classList.add('fa-list');
            document.body.style.overflow = ''; // Restore scrolling
        }
    }

    // Video Controls
    function toggleFullscreen() {
        const videoContainer = document.getElementById('video-container');
        if (document.fullscreenElement) {
            document.exitFullscreen();
        } else {
            videoContainer.requestFullscreen();
        }
        showToast('მთელი ეკრანის რეჟიმი');
    }

    function toggleTheater() {
        theaterMode = !theaterMode;
        const videoContainer = document.getElementById('video-container');
        const mainContent = videoContainer.closest('.flex-1');
        
        if (theaterMode) {
            mainContent.style.maxWidth = '100%';
            videoContainer.style.margin = '0';
            videoContainer.style.borderRadius = '0';
            showToast('თეატრალური რეჟიმი ჩართულია');
        } else {
            mainContent.style.maxWidth = '';
            videoContainer.style.margin = '';
            videoContainer.style.borderRadius = '';
            showToast('თეატრალური რეჟიმი გამორთულია');
        }
    }

    function toggleSettings() {
        const dropdown = document.getElementById('settings-dropdown');
        dropdown.classList.toggle('hidden');
    }

    // User Actions
    function toggleBookmark() {
        const icon = document.getElementById('bookmark-icon');
        const isBookmarked = icon.classList.contains('fas');
        
        if (isBookmarked) {
            icon.classList.remove('fas');
            icon.classList.add('far');
            showToast('წაშლილია ბუკმარკებიდან');
        } else {
            icon.classList.remove('far');
            icon.classList.add('fas');
            showToast('დამატებულია ბუკმარკებში');
        }
    }

    function shareVideo() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $video->title }}',
                url: window.location.href
            });
        } else {
            navigator.clipboard.writeText(window.location.href);
            showToast('ლინკი დაკოპირდა');
        }
    }

    // Search Functionality
    function setupPlaylistSearch() {
        const searchInput = document.getElementById('playlist-search');
        const clearBtn = document.getElementById('clear-search');
        
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const query = this.value.toLowerCase();
                const playlistItems = document.querySelectorAll('#playlist-sidebar .space-y-3 > .group');
                let visibleCount = 0;
                
                playlistItems.forEach(item => {
                    const title = item.getAttribute('data-video-title');
                    if (title.includes(query)) {
                        item.style.display = 'block';
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });
                
                // Show/hide clear button
                if (query.length > 0) {
                    clearBtn.classList.remove('hidden');
                } else {
                    clearBtn.classList.add('hidden');
                }
                
                // Update search results count
                updateSearchResults(visibleCount, playlistItems.length);
            });
        }
    }

    function clearSearch() {
        const searchInput = document.getElementById('playlist-search');
        const clearBtn = document.getElementById('clear-search');
        const playlistItems = document.querySelectorAll('#playlist-sidebar .space-y-3 > .group');
        
        searchInput.value = '';
        clearBtn.classList.add('hidden');
        
        playlistItems.forEach(item => {
            item.style.display = 'block';
        });
        
        updateSearchResults(playlistItems.length, playlistItems.length);
    }

    function updateSearchResults(visible, total) {
        // You can add a results counter here if needed
        console.log(`Showing ${visible} of ${total} videos`);
    }

    // Keyboard Shortcuts
    function setupKeyboardShortcuts() {
        document.addEventListener('keydown', function(e) {
            // Don't trigger if user is typing in an input
            if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') return;
            
            switch(e.key) {
                case 'f': // F - fullscreen
                case 'F':
                    e.preventDefault();
                    toggleFullscreen();
                    break;
                case 't': // T - theater mode
                case 'T':
                    e.preventDefault();
                    toggleTheater();
                    break;
                case 'ArrowRight': // Next video
                    if (e.ctrlKey) {
                        e.preventDefault();
                        const nextBtn = document.getElementById('next-video-btn');
                        if (nextBtn) nextBtn.click();
                    }
                    break;
                case 'ArrowLeft': // Previous video
                    if (e.ctrlKey) {
                        e.preventDefault();
                        const prevBtn = document.querySelector('a[href*="tutorials.show"]');
                        if (prevBtn && prevBtn.textContent.includes('წინა')) prevBtn.click();
                    }
                    break;
            }
        });
    }

    // Utility Functions
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    function showToast(message, type = 'info') {
        // Create toast notification
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 z-50 px-4 py-2 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full ${
            type === 'success' ? 'bg-green-500 text-white' : 'bg-slate-800 text-white'
        }`;
        toast.textContent = message;
        
        document.body.appendChild(toast);
        
        // Animate in
        setTimeout(() => toast.classList.remove('translate-x-full'), 100);
        
        // Remove after 3 seconds
        setTimeout(() => {
            toast.classList.add('translate-x-full');
            setTimeout(() => document.body.removeChild(toast), 300);
        }, 3000);
    }

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.relative')) {
            document.getElementById('settings-dropdown').classList.add('hidden');
        }
    });
    </script>
    @endpush
    
</x-layout>