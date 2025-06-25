<x-layout>
    <!-- Hero Section -->
    <section class="py-16 md:py-24">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-gray-900 dark:text-white mb-6">
                ჩვენი <span class="bg-gradient-to-r from-indigo-500 to-purple-600 bg-clip-text text-transparent">სერვისები</span>
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed">
                აირჩიეთ თქვენთვის სასურველი სერვისი და დაიწყეთ თქვენი პროფესიული განვითარება
            </p>
        </div>
    </section>

    <!-- Services Cards Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @php
                    $user = auth()->user();
                    if($user) {
                        $isPremium = $user->hasActiveSubscription();
                    } else {
                        $isPremium = false;
                    }
                @endphp
                
                <!-- Practice Tests Card -->
                <div class="group relative h-full">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-600 rounded-3xl blur opacity-20 group-hover:opacity-40 transition-all duration-500"></div>
                    <div class="relative bg-white dark:bg-gray-800/90 backdrop-blur-sm rounded-3xl shadow-xl overflow-hidden border border-gray-100/50 dark:border-gray-700/50 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 h-full flex flex-col">
                        <div class="h-52 sm:h-48 overflow-hidden flex-shrink-0 relative">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-black/10 to-transparent z-10"></div>
                            <img src="https://daily.jstor.org/wp-content/uploads/2015/05/standardizedtests.jpg" alt="Practice Tests" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute top-4 left-4 z-20">
                                <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                                    <i class="fas fa-clipboard-list text-white text-lg"></i>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 sm:p-5 lg:p-6 flex flex-col flex-grow">
                            <div class="flex items-start justify-between mb-4">
                                <h3 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">ტესტები</h3>
                                <div class="px-3 py-1.5 bg-gradient-to-r from-amber-500 to-amber-600 text-white text-xs font-semibold rounded-full shadow-lg flex items-center gap-1.5 flex-shrink-0">
                                    <i class="fas fa-crown text-xs"></i>
                                    <span>ფასიაინი</span>
                                </div>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 mb-6 leading-relaxed flex-grow text-sm sm:text-base">
                                მოემზადეთ გამოცდისთვის ჩვენი მრავალფეროვანი ტესტების საშუალებით. პრაქტიკული ტესტები შექმნილია რეალური გამოცდის მსგავსად და მოიცავს ყველა საჭირო თემას.
                            </p>
                            <button onclick="{{ $isPremium ? 'window.location.href=\''.route('questions').'\'' : 'showPremiumAlert()' }}" 
                                    class="w-full inline-flex items-center justify-center px-4 py-3 sm:px-6 sm:py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-semibold rounded-xl hover:from-indigo-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-300 transform hover:scale-105 hover:shadow-lg mt-auto group/btn">
                                <i class="fas fa-play mr-2 group-hover/btn:scale-110 transition-transform"></i>
                                <span class="text-sm sm:text-base">დაწყება</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Exam Simulation Card -->
                <div class="group relative h-full">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-600 rounded-3xl blur opacity-20 group-hover:opacity-40 transition-all duration-500"></div>
                    <div class="relative bg-white dark:bg-gray-800/90 backdrop-blur-sm rounded-3xl shadow-xl overflow-hidden border border-gray-100/50 dark:border-gray-700/50 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 h-full flex flex-col">
                        <div class="h-52 sm:h-48 overflow-hidden flex-shrink-0 relative">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-black/10 to-transparent z-10"></div>
                            <img src="https://admissions.rochester.edu/blog/wp-content/uploads/2015/08/test.png" alt="Exam Simulation" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute top-4 left-4 z-20">
                                <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                                    <i class="fas fa-graduation-cap text-white text-lg"></i>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 sm:p-5 lg:p-6 flex flex-col flex-grow">
                            <div class="flex items-start justify-between mb-4">
                                <h3 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">გამოცდის სიმულაცია</h3>
                                <div class="px-3 py-1.5 bg-gradient-to-r from-amber-500 to-amber-600 text-white text-xs font-semibold rounded-full shadow-lg flex items-center gap-1.5 flex-shrink-0">
                                    <i class="fas fa-crown text-xs"></i>
                                    <span>ფასიაინი</span>
                                </div>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 mb-6 leading-relaxed flex-grow text-sm sm:text-base">
                                გაიარეთ სრული გამოცდის სიმულაცია რეალური გამოცდის იდენტურ გარემოში. დროის ლიმიტი, კითხვების რაოდენობა და სირთულე შეესაბამება რეალურ გამოცდას.
                            </p>
                            <button onclick="{{ $isPremium ? 'window.location.href=\''.route('workspace').'\'' : 'showPremiumAlert()' }}" 
                                    class="w-full inline-flex items-center justify-center px-4 py-3 sm:px-6 sm:py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-semibold rounded-xl hover:from-indigo-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-300 transform hover:scale-105 hover:shadow-lg mt-auto group/btn">
                                <i class="fas fa-graduation-cap mr-2 group-hover/btn:scale-110 transition-transform"></i>
                                <span class="text-sm sm:text-base">სიმულაცია</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Video Tutorials Card -->
                <div class="group relative h-full">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-600 rounded-3xl blur opacity-20 group-hover:opacity-40 transition-all duration-500"></div>
                    <div class="relative bg-white dark:bg-gray-800/90 backdrop-blur-sm rounded-3xl shadow-xl overflow-hidden border border-gray-100/50 dark:border-gray-700/50 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 h-full flex flex-col">
                        <div class="h-52 sm:h-48 overflow-hidden flex-shrink-0 relative">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-black/10 to-transparent z-10"></div>
                            <img src="https://www.thedvigroup.com/wp-content/uploads/2023/08/Benefits-of-Video-Tutorials-Distance-Learner-Watching-Video-166191408_m_normal_none-1.jpg" alt="Video Tutorials" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute top-4 left-4 z-20">
                                <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                                    <i class="fas fa-video text-white text-lg"></i>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 sm:p-5 lg:p-6 flex flex-col flex-grow">
                            <div class="flex items-start justify-between mb-4">
                                <h3 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">ვიდეო გაკვეთილები</h3>
                                <div class="px-3 py-1.5 bg-gradient-to-r from-amber-500 to-amber-600 text-white text-xs font-semibold rounded-full shadow-lg flex items-center gap-1.5 flex-shrink-0">
                                    <i class="fas fa-crown text-xs"></i>
                                    <span>ფასიაინი</span>
                                </div>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 mb-6 leading-relaxed flex-grow text-sm sm:text-base">
                                უყურეთ დეტალურ ვიდეო გაკვეთილებს ნებისმიერ დროს. ჩვენი ექსპერტები გაგიზიარებენ თავიანთ ცოდნას და გამოცდილებას ყველა მნიშვნელოვან თემაზე.
                            </p>
                            <button onclick="{{ $isPremium ? 'window.location.href=\''.route('tutorials').'\'' : 'showPremiumAlert()' }}" 
                                    class="w-full inline-flex items-center justify-center px-4 py-3 sm:px-6 sm:py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-semibold rounded-xl hover:from-indigo-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-300 transform hover:scale-105 hover:shadow-lg mt-auto group/btn">
                                <i class="fas fa-video mr-2 group-hover/btn:scale-110 transition-transform"></i>
                                <span class="text-sm sm:text-base">ნახვა</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Premium Alert Modal -->
    <div id="premiumAlertModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full animate-fadeIn">
                <div class="relative">
                    <!-- Animated background effect -->
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="absolute -inset-4 bg-gradient-to-r from-amber-300/20 via-amber-500/10 to-amber-300/20 animate-gradient-x"></div>
                    </div>

                    <!-- Premium content -->
                    <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4 relative z-10">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-16 w-16 rounded-full bg-gradient-to-r from-amber-400 to-amber-600 sm:mx-0 sm:h-14 sm:w-14 shadow-lg relative overflow-hidden">
                                <div class="absolute inset-0 bg-amber-500 animate-pulse-slow opacity-50"></div>
                                <div class="crown-container animate-float">
                                    <i class="fas fa-crown text-white text-2xl"></i>
                                </div>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-xl leading-6 font-bold text-gray-900 dark:text-white">
                                    პრემიუმ სერვისი
                                </h3>
                                <div class="mt-3">
                                    <p class="text-base text-gray-700 dark:text-gray-300">
                                        ეს სერვისი ხელმისაწვდომია მხოლოდ პრემიუმ მომხმარებლებისთვის. გთხოვთ, შეიძინოთ წვდომა ჩვენი პრემიუმ პაკეტებიდან ერთ-ერთი, რათა ისარგებლოთ ამ სერვისით.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse relative z-10">
                        <a href="{{ route('pricing') }}" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-base font-medium text-white hover:from-indigo-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm transition-all hover:scale-105">
                            <span class="flex items-center">
                                <i class="fas fa-gem mr-2 animate-pulse"></i>
                                ნახეთ ფასები
                            </span>
                        </a>
                        <button type="button" onclick="closePremiumAlert()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-800 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-all">
                            დახურვა
                        </button>
                    </div>

                    <!-- Decorative elements -->
                    <div class="absolute top-0 left-0 w-20 h-20 bg-gradient-to-br from-amber-300/30 to-transparent rounded-br-full"></div>
                    <div class="absolute bottom-0 right-0 w-20 h-20 bg-gradient-to-tl from-amber-300/30 to-transparent rounded-tl-full"></div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes gradient-x {
            0% { transform: translateX(-50%); }
            100% { transform: translateX(50%); }
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: scale(0.95); }
            100% { opacity: 1; transform: scale(1); }
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0px); }
        }

        @keyframes pulse-slow {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.6; }
        }

        .animate-gradient-x {
            animation: gradient-x 8s linear infinite;
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out forwards;
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .animate-pulse-slow {
            animation: pulse-slow 3s ease-in-out infinite;
        }

        .crown-container {
            position: relative;
            z-index: 10;
        }
    </style>

    <script>
        function showPremiumAlert() {
            document.getElementById('premiumAlertModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closePremiumAlert() {
            document.getElementById('premiumAlertModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    </script>
</x-layout>
