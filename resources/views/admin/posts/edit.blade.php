<x-admin.layout>
    <div class="min-h-screen bg-gray-900 dark:bg-dark py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gray-800 dark:bg-gray-800 rounded-xl shadow-sm p-8">
                <h1 class="text-2xl font-bold text-white dark:text-white mb-8">სიახლის რედაქტირება</h1>
                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-lg bg-red-900/50 border border-red-800">
                        <h3 class="text-lg font-medium text-red-300 mb-2">შეცდომები:</h3>
                        <ul class="list-disc pl-5 text-red-400 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-200 dark:text-gray-200 mb-1">სათაური</label>
                        <input 
                            type="text"
                            name="title" 
                            id="title" 
                            class="w-full rounded-lg border-gray-600 bg-gray-700 text-white dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm focus:ring focus:ring-blue-400 focus:border-blue-500 transition duration-200" 
                            placeholder="შეიყვანეთ პოსტის სათაური"
                            value="{{ old('title', $post->title) }}"
                            required
                        />
                        @error('title')
                            <p class="mt-1 text-sm text-red-400 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="thumbnail" class="block text-sm font-medium text-gray-200 dark:text-gray-200 mb-1">მინიატურა</label>
                        @if($post->image)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $post->image->path) }}" alt="{{ $post->title }}" class="h-32 w-auto rounded-lg border border-gray-600">
                            </div>
                        @endif
                        <input 
                            type="file" 
                            name="thumbnail" 
                            id="thumbnail" 
                            class="w-full rounded-lg border border-gray-600 bg-gray-700 text-white px-3 py-2
                                file:mr-4 file:py-2 file:px-4 
                                file:rounded-full file:border-0 
                                file:text-sm file:font-medium
                                file:bg-blue-800 file:text-blue-200 
                                hover:file:bg-blue-700
                                focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500
                                transition duration-200
                                dark:bg-gray-700 dark:text-white dark:border-gray-600"
                            accept="image/*"
                        />
                        @error('thumbnail')
                            <p class="mt-1 text-sm text-red-400 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="body" class="block text-sm font-medium text-gray-200 dark:text-gray-200 mb-1">შინაარსი</label>
                        <textarea 
                            name="body" 
                            id="body" 
                            rows="10" 
                            class="w-full rounded-lg border-gray-600 bg-gray-700 text-white dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm focus:ring focus:ring-blue-400 focus:border-blue-500 transition duration-200" 
                            placeholder="შეიყვანეთ პოსტის შინაარსი"
                            required
                        >{{ old('body', $post->body) }}</textarea>
                        @error('body')
                            <p class="mt-1 text-sm text-red-400 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-between pt-4">
                        <div class="flex space-x-3">
                            <a href="{{ route('posts.show', $post) }}" class="inline-flex items-center px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                უკან დაბრუნება
                            </a>
                            @auth
                                @if(auth()->user()->is_admin)
                                    <button 
                                        type="button" 
                                        onclick="confirmDelete()" 
                                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-lg font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors"
                                    >
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        წაშლა
                                    </button>
                                @endif
                            @endauth
                        </div>
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-lg font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            შენახვა
                        </button>
                    </div>
                </form>

                <!-- Delete Form (Hidden) -->
                @auth
                    @if(auth()->user()->is_admin)
                        <form id="deleteForm" method="POST" action="{{ route('posts.destroy', $post) }}" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal Script -->
    @auth
        @if(auth()->user()->is_admin)
            <script>
                function confirmDelete() {
                    if (confirm('დარწმუნებული ხართ, რომ გსურთ ამ სიახლის წაშლა? ეს მოქმედება შეუქცევადია.')) {
                        document.getElementById('deleteForm').submit();
                    }
                }
            </script>
        @endif
    @endauth
</x-admin.layout>
