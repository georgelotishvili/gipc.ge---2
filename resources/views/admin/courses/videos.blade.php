<x-admin.layout>
    <div class="min-h-screen bg-white dark:bg-dark relative overflow-hidden">
        <div class="relative z-10 max-w-[1920px] mx-auto px-6 py-8">
            <!-- Header -->
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">
                    სასწავლო <span class="bg-gradient-to-r from-primary-400 to-blue-400 bg-clip-text text-transparent">ვიდეოები</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                    გაეცანით ჩვენს საგანმანათლებლო ვიდეო რესურსებს არქიტექტურული სერტიფიცირებისთვის
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="mb-8 flex justify-between items-center">
                <a href="{{ route('admin.courses.chapters', $course) }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-md transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    უკან დაბრუნება
                </a>
                
                <a href="{{ route('admin.courses.chapters.videos.create', ['course' => $course, 'chapter' => $chapter]) }}" 
                   class="inline-flex items-center px-4 py-2 bg-primary-500 hover:bg-primary-600 text-white text-sm font-medium rounded-md transition-colors duration-200">
                    <i class="fas fa-plus mr-2"></i>
                    ახალი ვიდეოს დამატება
                </a>
            </div>

            <!-- Video Grid -->
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5">
                @foreach($chapter->videos as $video)
                <div class="bg-white dark:bg-dark-2 rounded-md overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 h-full flex flex-col">
                    <div class="aspect-video relative">
                        <video class="w-full h-full object-cover">
                            <source src="{{ Storage::url($video->path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="w-14 h-14 rounded-md bg-white/90 flex items-center justify-center">
                                    <i class="fas fa-play text-gray-900 text-xl ml-1"></i>
                                </span>
                            </div>
                        </div>
                        <div class="absolute bottom-3 right-3 bg-black/80 text-white px-2.5 py-1 rounded-md text-sm font-medium">
                            {{ $video->duration }}
                        </div>
                    </div>
                    <div class="p-5 flex flex-col flex-grow">
                        <div class="flex-grow">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                {{ $video->title }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-2">
                                {{ $video->description }}
                            </p>
                        </div>
                        <div class="flex items-center justify-between mt-4">
                            <div class="flex items-center gap-4 text-sm text-gray-500 dark:text-gray-400">
                                <span class="inline-flex items-center gap-1.5">
                                    <i class="far fa-calendar text-gray-400"></i>
                                    {{ $video->created_at->format('d M, Y') }}
                                </span>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.courses.chapters.videos.edit', ['course' => $course, 'chapter' => $chapter, 'video' => $video]) }}" 
                                   class="inline-flex items-center px-3 py-1.5 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md transition-colors duration-200">
                                    <i class="fas fa-edit mr-1.5"></i>
                                    რედაქტირება
                                </a>
                                <form action="{{ route('admin.courses.chapters.videos.destroy', ['course' => $course, 'chapter' => $chapter, 'video' => $video]) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-md transition-colors duration-200"
                                            onclick="return confirm('დარწმუნებული ხართ?')">
                                        <i class="fas fa-trash mr-1.5"></i>
                                        წაშლა
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
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
