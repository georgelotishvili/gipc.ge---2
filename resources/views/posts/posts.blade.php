<x-layout>
    <div class="min-h-screen dark:bg-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">სიახლეები</h1>
                <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">უახლესი ინფორმაცია და სიახლეები ჩვენი გუნდისგან</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($posts as $post)
                <article class="group bg-white/70 dark:bg-gray-800/50 backdrop-blur-xl rounded-3xl border border-gray-200/50 dark:border-gray-700/50 overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col h-full">
                    <div class="relative overflow-hidden h-56">
                        <img src="{{ asset('storage/' . $post->image->path) }}" alt="{{ $post->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        @auth
                            @if(auth()->user()->is_admin)
                                <div class="absolute top-3 right-3 flex space-x-2 z-10">
                                    <a href="{{ route('admin.posts.edit', $post) }}" class="bg-blue-600 text-white p-2 rounded-full hover:bg-blue-700 transition-colors shadow-lg">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <button onclick="confirmDelete('{{ $post->id }}')" class="bg-red-600 text-white p-2 rounded-full hover:bg-red-700 transition-colors shadow-lg">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                    <form id="delete-form-{{ $post->id }}" action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                    
                    <div class="p-8 flex flex-col flex-grow">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 line-clamp-2">
                            <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                                {{ $post->title }}
                            </a>
                        </h2>
                        
                        <p class="text-gray-600 dark:text-gray-400 mb-6 line-clamp-3 flex-grow">
                            {{ Str::limit(strip_tags($post->body), 150) }}
                        </p>
                        
                        <div class="flex items-center justify-between mt-auto">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $post->created_at->format('Y-m-d') }}
                            </span>
                            
                            <a href="{{ route('posts.show', $post->slug) }}" 
                               class="inline-flex items-center px-6 py-3 bg-primary-600/90 dark:bg-primary-500/90 text-white rounded-xl hover:bg-primary-700 dark:hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                                სრულად ნახვა
                                <svg class="w-5 h-5 ml-2 animate-bounce-x" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
                @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12">
                    <p class="text-xl text-gray-600 dark:text-gray-400">ამჟამად სიახლეები არ არის.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    @auth
        @if(auth()->user()->is_admin)
            <!-- Fixed Add Post Button for Admin -->
            <a href="{{ route('admin.posts.create') }}" 
               class="fixed bottom-8 right-8 bg-primary-600 text-white p-4 rounded-full shadow-lg hover:bg-primary-700 transition-all duration-300 transform hover:scale-110 z-50 flex items-center justify-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span class="font-medium">დაამატე სიახლე</span>
            </a>
            
            <script>
                function confirmDelete(postId) {
                    if (confirm('დარწმუნებული ხართ, რომ გსურთ ამ სიახლის წაშლა?')) {
                        document.getElementById('delete-form-' + postId).submit();
                    }
                }
            </script>
        @endif
    @endauth
</x-layout>
