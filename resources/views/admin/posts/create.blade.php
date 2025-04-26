<x-admin.layout>
<div class="min-h-screen bg-gray-900 dark:bg-dark py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gray-800 dark:bg-gray-800 rounded-xl shadow-sm p-8">
            <h1 class="text-2xl font-bold text-white dark:text-white mb-8">ახალი პოსტის გამოქვეყნება</h1>
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
            <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-200 dark:text-gray-200 mb-1">სათაური</label>
                    <input 
                        type="text"
                        name="title" 
                        id="title" 
                        class="w-full rounded-lg border-gray-600 bg-gray-700 text-white dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm focus:ring focus:ring-blue-400 focus:border-blue-500 transition duration-200" 
                        placeholder="შეიყვანეთ პოსტის სათაური"
                        value="{{ old('title') }}"
                        required
                    />
                    @error('title')
                        <p class="mt-1 text-sm text-red-400 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="thumbnail" class="block text-sm font-medium text-gray-200 dark:text-gray-200 mb-1">მინიატურა</label>
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
                        required
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
                        rows="8" 
                        class="w-full rounded-lg border-gray-600 bg-gray-700 text-white dark:bg-gray-700 dark:text-white dark:border-gray-600 shadow-sm focus:ring focus:ring-blue-400 focus:border-blue-500 transition duration-200"
                        placeholder="დაწერეთ თქვენი პოსტის შინაარსი აქ..."
                        required
                    >{{ old('body') }}</textarea>
                    @error('body')
                        <p class="mt-1 text-sm text-red-400 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4">
                    <button 
                        type="submit" 
                        class="w-full bg-blue-700 text-white px-6 py-3 rounded-lg font-medium
                               hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500
                               transform transition duration-200 hover:scale-[1.02]
                               dark:bg-blue-700 dark:hover:bg-blue-800"
                    >
                        პოსტის გამოქვეყნება
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</x-layout>
