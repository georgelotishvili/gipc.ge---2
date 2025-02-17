<x-layout>
    <div class="min-h-screen bg-white dark:bg-dark relative overflow-hidden pt-24">
        <div class="relative z-10">
            <!-- Video Section -->
            <div class="w-full dark:bg-dark border-b border-gray-800 relative">
                <div class="container mx-auto px-4 relative">
                    <div class="max-w-6xl mx-auto py-8">
                        <!-- Full Width Video Player -->
                        <div class="w-full rounded-lg overflow-hidden shadow-lg">
                            <video controls class="w-full aspect-video">
                                <source src="https://gipc.b-cdn.net/%E1%83%96%E1%83%9D%E1%83%92%E1%83%90%E1%83%93%E1%83%98%20%E1%83%9B%E1%83%98%E1%83%9B%E1%83%9D%E1%83%AE%E1%83%98%E1%83%9A%E1%83%95%E1%83%90.mp4" type="video/mp4">
                                <source src="movie.ogg" type="video/ogg">
                                Your browser does not support the video tag.
                            </video>
                        </div>

                        <!-- Video Info -->
                        <div class="p-6 bg-white dark:bg-gray-800 rounded-b-lg">
                            <h5 class="text-gray-900 dark:text-white text-2xl font-medium mb-2">სერტიფიცირების პროცესის მიმოხილვა</h5>
                            <p class="text-gray-700 dark:text-gray-300 text-base mb-4">
                                დეტალური ინფორმაცია სერტიფიცირების პროცესის შესახებ
                            </p>
                            <div class="flex items-center gap-4 text-sm text-gray-500 dark:text-gray-400">
                                <span class="flex items-center gap-2">
                                    <i class="far fa-eye"></i>
                                    1,234 ნახვა
                                </span>
                                <span class="flex items-center gap-2">
                                    <i class="far fa-calendar"></i>
                                    15 მარტი, 2024
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="container mx-auto px-4 py-12">
                <div class="max-w-6xl mx-auto">
                    <!-- Video Info with Glass Effect -->
                    <div class="mb-12 p-8 bg-white/5 backdrop-blur-xl rounded-2xl border border-gray-200/10 dark:border-gray-700/30 shadow-lg">
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4 tracking-tight">
                            სერტიფიცირების პროცესის <span class="bg-gradient-to-r from-primary-400 to-blue-400 bg-clip-text text-transparent">მიმოხილვა</span>
                        </h1>
                        <div class="flex flex-wrap items-center gap-6 text-gray-600 dark:text-gray-400 mb-6">
                            <span class="flex items-center gap-2 bg-gray-100 dark:bg-gray-800/50 px-3 py-1 rounded-full">
                                <i class="far fa-clock"></i>
                                15:30
                            </span>
                            <span class="flex items-center gap-2 bg-gray-100 dark:bg-gray-800/50 px-3 py-1 rounded-full">
                                <i class="far fa-calendar"></i>
                                2024 წლის 15 მარტი
                            </span>
                            <span class="flex items-center gap-2 bg-gray-100 dark:bg-gray-800/50 px-3 py-1 rounded-full">
                                <i class="far fa-eye"></i>
                                1,234 ნახვა
                            </span>
                        </div>
                        <div class="prose prose-lg dark:prose-invert max-w-none">
                            <p class="text-gray-600 dark:text-gray-300">დეტალური ინფორმაცია სერტიფიცირების პროცესის შესახებ. აქ შეგიძლიათ გაეცნოთ ყველა საჭირო ეტაპს და მოთხოვნას.</p>
                        </div>
                    </div>

                    <!-- Author Section with Enhanced Design -->
                    <div class="flex items-center gap-6 p-8 bg-gradient-to-r from-primary-500/10 to-blue-500/10 rounded-2xl backdrop-blur-sm border border-gray-200/20 dark:border-gray-700/30 shadow-lg mb-12">
                        <div class="relative">
                            <div class="absolute -inset-1 bg-gradient-to-r from-primary-500 to-blue-500 rounded-full blur opacity-70"></div>
                            <img src="https://api.dicebear.com/7.x/initials/svg?seed=GL&backgroundType=gradientLinear&backgroundColor=003c96" 
                                 alt="გიორგი ლოთიშვილი"
                                 class="relative w-16 h-16 rounded-full">
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">გიორგი ლოთიშვილი</h3>
                            <p class="text-gray-600 dark:text-gray-400">არქიტექტურის სპეციალისტი</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-layout> 