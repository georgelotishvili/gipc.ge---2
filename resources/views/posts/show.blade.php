<x-layout>
    <div class="min-h-screen py-12 px-4 sm:px-6">
        <div class="max-w-4xl mx-auto">
            <!-- Back button -->
            <div class="mb-8">
                <a href="{{ route('posts.index') }}" 
                   class="group inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200">
                    <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    უკან დაბრუნება
                </a>
            </div>
            
            <!-- Article header -->
            <header class="relative mb-12">
                <div class="absolute inset-0 bg-gradient-to-r from-primary-600/10 to-primary-400/10 dark:from-primary-600/5 dark:to-primary-400/5 rounded-3xl"></div>
                <div class="relative px-6 py-8">
                    <h1 class="text-4xl md:text-5xl font-black text-gray-900 dark:text-white leading-tight mb-4 break-words">
                        {{ $post->title }}
                    </h1>
                    
                    <div class="flex flex-wrap items-center gap-4 text-gray-600 dark:text-gray-400">
                        <div class="flex items-center bg-white dark:bg-gray-800 px-3 py-1 rounded-full shadow-sm">
                            <svg class="w-4 h-4 mr-2 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-sm">{{ $post->created_at->format('Y-m-d') }}</span>
                        </div>
                        
                        <div class="flex items-center bg-white dark:bg-gray-800 px-3 py-1 rounded-full shadow-sm">
                            <svg class="w-4 h-4 mr-2 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="text-sm">{{ $post->user->name ?? 'Admin' }}</span>
                        </div>
                        
                        @auth
                            @if(auth()->user()->is_admin)
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.posts.edit', $post) }}" class="flex items-center bg-blue-600 text-white px-3 py-1 rounded-full shadow-sm hover:bg-blue-700 transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        <span class="text-sm">რედაქტირება</span>
                                    </a>
                                    
                                    <button 
                                        onclick="confirmDelete()"
                                        class="flex items-center bg-red-600 text-white px-3 py-1 rounded-full shadow-sm hover:bg-red-700 transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <span class="text-sm">წაშლა</span>
                                    </button>
                                    
                                    <form id="delete-form" action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            </header>
            
            <!-- Featured image -->
            <div class="mb-12">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl group">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <img 
                        src="{{ asset('storage/' . $post->image->path) }}" 
                        alt="{{ $post->title }}" 
                        class="w-full h-[500px] object-cover transform group-hover:scale-105 transition-transform duration-700"
                    >
                </div>
            </div>
            
            <!-- Article content -->
            <article class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl p-8 md:p-12 backdrop-blur-lg bg-opacity-95 dark:bg-opacity-90 border border-gray-100 dark:border-gray-700">
                <div class="prose prose-lg md:prose-xl max-w-none dark:prose-invert 
                    prose-headings:text-gray-900 dark:prose-headings:text-white
                    prose-headings:font-bold prose-p:text-gray-700 dark:prose-p:text-gray-300
                    prose-a:text-primary-600 dark:prose-a:text-primary-400 
                    prose-a:no-underline hover:prose-a:text-primary-700
                    prose-img:rounded-xl prose-strong:text-primary-700 dark:prose-strong:text-primary-400
                    break-words">
                    {!! $post->body !!}
                </div>
                
                <!-- Share buttons -->
                <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">გააზიარე:</h3>
                    <div class="flex gap-3">
                        @php
                            $shareUrl = urlencode(request()->url());
                            $shareTitle = urlencode($post->title);
                        @endphp
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" 
                           target="_blank"
                           class="flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 transition-all duration-200 text-white shadow-lg hover:shadow-blue-500/25">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/>
                            </svg>
                        </a>
                        <a href="https://twitter.com/intent/tweet?text={{ $shareTitle }}&url={{ $shareUrl }}" 
                           target="_blank"
                           class="flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-500 hover:from-blue-500 hover:to-blue-600 transition-all duration-200 text-white shadow-lg hover:shadow-blue-400/25">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723 10.054 10.054 0 01-3.127 1.184 4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ $shareUrl }}&title={{ $shareTitle }}" 
                           target="_blank"
                           class="flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-br from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 transition-all duration-200 text-white shadow-lg hover:shadow-blue-600/25">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </article>
            
            <!-- Related posts -->
            @php
                $relatedPosts = App\Models\Post::where('id', '!=', $post->id)
                    ->latest()
                    ->take(3)
                    ->get();
            @endphp
            
            @if($relatedPosts->isNotEmpty())
            <div class="mt-16">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">მსგავსი სიახლეები</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedPosts as $relatedPost)
                    <a href="{{ route('posts.show', $relatedPost) }}" 
                       class="group bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="relative h-48 overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10"></div>
                            <img 
                                src="{{ asset('storage/' . $relatedPost->image->path) }}" 
                                alt="{{ $relatedPost->title }}" 
                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700"
                            >
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors duration-200 break-words">
                                {{ $relatedPost->title }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 line-clamp-3 break-words">
                                {{ Str::limit(strip_tags($relatedPost->body), 150) }}
                            </p>
                            <span class="inline-flex items-center text-primary-600 dark:text-primary-400 font-medium group-hover:text-primary-700 dark:group-hover:text-primary-300 transition-colors">
                                სრულად ნახვა
                                <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>

    @auth
        @if(auth()->user()->is_admin)
            <script>
                function confirmDelete() {
                    if (confirm('დარწმუნებული ხართ, რომ გსურთ ამ სიახლის წაშლა?')) {
                        document.getElementById('delete-form').submit();
                    }
                }
            </script>
        @endif
    @endauth
</x-layout>
