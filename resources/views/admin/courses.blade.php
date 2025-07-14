<x-admin.layout>
    <div class="min-h-screen bg-white dark:bg-dark relative overflow-hidden">
        <div class="relative z-10 max-w-[1920px] mx-auto px-6 py-8">
            <!-- Header -->
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">
                    სასწავლო <span class="bg-gradient-to-r from-primary-400 to-blue-400 bg-clip-text text-transparent">კურსები</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                    გაეცანით ჩვენს საგანმანათლებლო კურსებს არქიტექტურული სერტიფიცირებისთვის
                </p>
            </div>

            <!-- Create Course Button -->
            <div class="mb-8 flex justify-end">
                <a href="{{ route('admin.courses.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-primary-500 hover:bg-primary-600 text-white text-sm font-medium rounded-md transition-colors duration-200">
                    <i class="fas fa-plus mr-2"></i>
                    ახალი კურსის დამატება
                </a>
            </div>

            @if($courses->count() > 0)
                <!-- Courses Grid -->
                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5">
                    @foreach($courses as $course)
                    <div class="bg-white dark:bg-dark-2 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 h-full flex flex-col">
                        <div class="aspect-video relative bg-gray-100 dark:bg-dark-3">
                            @if($course->image()->first())
                                <a href="{{ route('admin.courses.chapters', $course->id) }}">
                                    <img src="{{ Storage::url($course->image()->first()->path) }}" alt="{{ $course->name }}" class="absolute inset-0 w-full h-full object-cover">
                                </a>
                            @else
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span class="w-14 h-14 rounded-full bg-gray-200 dark:bg-dark-4 flex items-center justify-center">
                                        <i class="fas fa-book text-gray-600 dark:text-gray-300 text-xl"></i>
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="p-5 flex flex-col flex-grow">
                            <div class="flex-grow">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 line-clamp-2">
                                    <a href="{{ route('admin.courses.edit', $course->id) }}" class="hover:text-primary-500 transition-colors duration-200">
                                        {{ $course->name }}
                                    </a>
                                </h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-3">
                                    {{ $course->description }}
                                </p>
                            </div>
                            <div class="flex items-center justify-between mt-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.courses.edit', $course->id) }}" 
                                       class="inline-flex items-center px-3 py-1.5 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md transition-colors duration-200">
                                        <i class="fas fa-edit mr-1.5"></i>
                                        რედაქტირება
                                    </a>
                                    <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-md transition-colors duration-200"
                                                onclick="return confirm('დარწმუნებული ხართ?')">
                                            <i class="fas fa-trash-alt mr-1.5"></i>
                                            წაშლა
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-12">
                    <div class="w-48 h-48 relative mb-8">
                        <div class="absolute inset-0 flex items-center justify-center animate-pulse">
                            <i class="fas fa-video text-8xl text-primary-400"></i>
                        </div>
                        <div class="absolute inset-0 border-4 border-t-primary-500 border-r-transparent border-b-transparent border-l-transparent rounded-full animate-spin"></div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-2">კურსები მზადდება</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-center max-w-md">
                        ამჟამად მიმდინარეობს კურსების ჩაწერა. გთხოვთ, შეამოწმოთ მოგვიანებით.
                    </p>
                </div>
            @endif
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

    @endpush
</x-admin.layout>
