<x-admin.layout>
    <div class="min-h-screen bg-white dark:bg-dark relative overflow-hidden">
        <div class="relative z-10 max-w-[1920px] mx-auto px-6 py-8">
            <!-- Header -->
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">
                    კურსის <span class="bg-gradient-to-r from-primary-400 to-blue-400 bg-clip-text text-transparent">თავები</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                    მართეთ კურსის თავები და ვიდეო გაკვეთილები
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="mb-8 flex justify-between items-center">
                <a href="{{ route('admin.courses') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-md transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    უკან დაბრუნება
                </a>
                
                <a href="{{ route('admin.courses.chapters.create', $course) }}" 
                   class="inline-flex items-center px-4 py-2 bg-primary-500 hover:bg-primary-600 text-white text-sm font-medium rounded-md transition-colors duration-200">
                    <i class="fas fa-plus mr-2"></i>
                    ახალი თავის დამატება
                </a>
            </div>

            @if($course->chapters->count() > 0)
                <!-- Chapters List -->
                <div class="max-w-4xl mx-auto space-y-4">
                    @foreach($course->chapters as $chapter)
                    <div class="bg-white dark:bg-dark-2 rounded-lg shadow-sm flex">
                        <div class="w-48 h-32 relative bg-gray-100 dark:bg-dark-3 rounded-l-lg flex-shrink-0">
                            @if($chapter->image()->first())
                                <a href="{{ route('admin.courses.chapters.videos', ['course' => $course, 'chapter' => $chapter]) }}">
                                    <img src="{{ Storage::url($chapter->image()->first()->path) }}" alt="{{ $chapter->name }}" class="absolute inset-0 w-full h-full object-cover rounded-l-lg">
                                </a>
                            @else
                                <a href="{{ route('admin.courses.chapters.videos', ['course' => $course, 'chapter' => $chapter]) }}" class="absolute inset-0 flex items-center justify-center">
                                    <i class="fas fa-book-open text-gray-400 text-3xl"></i>
                                </a>
                            @endif
                        </div>
                        
                        <div class="p-4 flex-grow flex justify-between">
                            <div class="flex flex-col justify-between">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        <a href="{{ route('admin.courses.chapters.videos', ['course' => $course, 'chapter' => $chapter]) }}" class="hover:text-primary-500 transition-colors duration-200">
                                            {{ $chapter->name }}
                                        </a>
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 line-clamp-2">
                                        <a href="{{ route('admin.courses.chapters.videos', ['course' => $course, 'chapter' => $chapter]) }}" class="hover:text-primary-500 transition-colors duration-200">
                                            {{ $chapter->description }}
                                        </a>
                                    </p>
                                </div>
                                <div class="text-sm text-gray-500">
                                    <span>{{ $chapter->videos->count() }} ვიდეო</span>
                                </div>
                            </div>
                            
                            <div class="flex flex-col justify-between items-end">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.courses.chapters.edit', ['course' => $course, 'chapter' => $chapter]) }}" 
                                       class="inline-flex items-center px-3 py-1.5 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md transition-colors duration-200">
                                        <i class="fas fa-edit mr-1.5"></i>
                                        რედაქტირება
                                    </a>
                                    <form action="{{ route('admin.courses.chapters.destroy', ['course' => $course, 'chapter' => $chapter]) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('დარწმუნებული ხართ რომ გსურთ თავის წაშლა?')"
                                                class="inline-flex items-center px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-md transition-colors duration-200">
                                            <i class="fas fa-trash-alt mr-1.5"></i>
                                            წაშლა
                                        </button>
                                    </form>
                                </div>
                                <a href="{{ route('admin.courses.chapters.videos.create', ['course' => $course, 'chapter' => $chapter]) }}" class="text-primary-500 hover:text-primary-600 text-sm font-medium">
                                    <i class="fas fa-plus mr-1"></i>
                                    ვიდეოს დამატება
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-12">
                    <div class="w-48 h-48 relative mb-8">
                        <div class="absolute inset-0 flex items-center justify-center animate-pulse">
                            <i class="fas fa-book-open text-8xl text-primary-400"></i>
                        </div>
                        <div class="absolute inset-0 border-4 border-t-primary-500 border-r-transparent border-b-transparent border-l-transparent rounded-full animate-spin"></div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-2">თავები არ არის დამატებული</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-center max-w-md">
                        დაამატეთ პირველი თავი ამ კურსისთვის ზემოთ მოცემული ღილაკის გამოყენებით
                    </p>
                </div>
            @endif
        </div>
    </div>

    @push('styles')
        <style>
            [x-cloak] { display: none !important; }
        </style>
    @endpush

</x-admin.layout>
