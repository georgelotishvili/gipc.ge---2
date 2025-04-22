<x-admin.layout>
    <div class="min-h-screen bg-white dark:bg-dark relative overflow-hidden">
        <div class="relative z-10 max-w-[1920px] mx-auto px-6 py-8">
            <!-- Header -->
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">
                    კურსის <span class="bg-gradient-to-r from-primary-400 to-blue-400 bg-clip-text text-transparent">ვიდეოები</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                    მართეთ კურსის ვიდეო გაკვეთილები
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="mb-8 flex justify-between items-center">
                <a href="{{ route('admin.courses.chapters.videos', [$course, $chapter]) }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-md transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    უკან დაბრუნება
                </a>
            </div>

            <div style="position:relative;padding-top:56.25%;"><iframe src="https://iframe.mediadelivery.net/embed/{{$video->library_id}}/{{$video->video_id}}?autoplay=true&loop=false&muted=false&preload=true&responsive=true" loading="lazy" style="border:0;position:absolute;top:0;height:100%;width:100%;" allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture;" allowfullscreen="true"></iframe></div>
        </div>
    </div>

    @push('styles')
        <style>
            [x-cloak] { display: none !important; }
        </style>
    @endpush

</x-admin.layout>
