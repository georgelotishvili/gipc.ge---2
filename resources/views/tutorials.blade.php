<x-layout>
    <div class="min-h-screen bg-white dark:bg-dark relative overflow-hidden pt-16">
        <div class="relative z-10 container mx-auto px-6 py-16">
            <!-- Header -->
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">
                    სასწავლო <span class="bg-gradient-to-r from-primary-400 to-blue-400 bg-clip-text text-transparent">ვიდეოები</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                    გაეცანით ჩვენს საგანმანათლებლო ვიდეო რესურსებს არქიტექტურული სერტიფიცირებისთვის
                </p>
            </div>

            <!-- Video Grid -->
            <div class="grid place-items-center">
                <!-- Video Card -->
                <a href="{{ route('tutorials.show', 'zogadi-mimoxilva') }}" class="group h-full max-w-2xl">
                    <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 h-full flex flex-col">
                        <div class="aspect-video relative">
                            <video class="w-full h-full object-cover">
                                <source src="https://gipc.b-cdn.net/ზოგადი%20მიმოხილვა.mp4" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300">
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span class="w-14 h-14 rounded-full bg-white/90 flex items-center justify-center transform group-hover:scale-105 transition-transform duration-300">
                                        <i class="fas fa-play text-gray-900 text-xl ml-1"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="absolute bottom-3 right-3 bg-black/80 text-white px-2.5 py-1 rounded-md text-sm font-medium">
                                15:30
                            </div>
                        </div>
                        <div class="p-5 flex flex-col flex-grow">
                            <div class="flex-grow">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 group-hover:text-primary-500 transition-colors line-clamp-2">
                                    სერტიფიცირების პროცესის მიმოხილვა
                                </h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-2">
                                    დეტალური ინფორმაცია სერტიფიცირების პროცესის შესახებ
                                </p>
                            </div>
                            <div class="flex items-center gap-4 text-sm text-gray-500 dark:text-gray-400 mt-4">
                                <span class="inline-flex items-center gap-1.5">
                                    <i class="far fa-calendar text-gray-400"></i>
                                    15 მარტი, 2024
                                </span>
                                <span class="inline-flex items-center gap-1.5">
                                    <i class="far fa-eye text-gray-400"></i>
                                    1,234 ნახვა
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
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
    <script src="{{ asset('js/video-player.js') }}"></script>
    @endpush
</x-layout>