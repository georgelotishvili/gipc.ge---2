<x-layout>
    <!-- Features Section -->
    <section class="py-6 md:py-16 bg-white dark:bg-gray-900">
        <div class="max-w-[120rem] mx-auto px-3 sm:px-6 lg:px-12">
            <h1 class="text-2xl md:text-4xl font-bold pb-6 text-gray-900 text-center dark:text-white mb-6">საქართველოს პროფესიული სერტიფიცირების ინსტიტუტი</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8 w-full px-4 sm:px-6 lg:px-8">
                <!-- Jobs Card -->
                <a href="{{ route('jobs') }}" wire:navigate class="group bg-white dark:bg-gray-800/50 p-4 md:p-8 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100 dark:border-gray-700/50 backdrop-blur-sm relative overflow-hidden cursor-pointer h-full">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-500/5 to-primary-500/0 dark:from-primary-400/10 dark:to-primary-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-10 h-10 md:w-14 md:h-14 bg-primary-100 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400 rounded-xl mb-3 md:mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-briefcase text-lg md:text-2xl"></i>
                        </div>
                        <h3 class="text-base md:text-xl font-bold text-gray-900 dark:text-white mb-1.5 md:mb-4 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">ვაკანსიები არქიტექტორებისთვის</h3>
                        <p class="text-xs md:text-base text-gray-700 dark:text-gray-300 leading-relaxed">შეგიძლიათ მოიძიოთ ან შესთავაზოთ სამუშაო სამშენებლო სფეროს სხვადასხვა დარგის სპეციალისტებს</p>
                    </div>
                </a>

                <!-- posts card -->
                <a href="{{ route('posts.index') }}" class="group bg-white dark:bg-gray-800/50 p-4 md:p-8 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100 dark:border-gray-700/50 backdrop-blur-sm relative overflow-hidden h-full">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-500/5 to-primary-500/0 dark:from-primary-400/10 dark:to-primary-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-10 h-10 md:w-14 md:h-14 bg-primary-100 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400 rounded-xl mb-3 md:mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-newspaper text-lg md:text-2xl"></i>
                        </div>
                        <h3 class="text-base md:text-xl font-bold text-gray-900 dark:text-white mb-1.5 md:mb-4 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">სიახლე</h3>
                        <p class="text-xs md:text-base text-gray-700 dark:text-gray-300 leading-relaxed">სამშენებლო სექტორში არსებული სიახლეების, რეგულაციებში შეტანილი ცვლილებებისა და განახლებების საინფორმაციო ბაზა</p>
                    </div>
                </a>

                <!-- Simulation Exam Card -->
                <a href="{{ route('regulations') }}" wire:navigate class="group bg-white dark:bg-gray-800/50 p-4 md:p-8 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100 dark:border-gray-700/50 backdrop-blur-sm relative overflow-hidden h-full">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-500/5 to-primary-500/0 dark:from-primary-400/10 dark:to-primary-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-10 h-10 md:w-14 md:h-14 bg-primary-100 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400 rounded-xl mb-3 md:mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-book text-lg md:text-2xl"></i>
                        </div>
                        <h3 class="text-base md:text-xl font-bold text-gray-900 dark:text-white mb-1.5 md:mb-4 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">სამშენებლო რეგულაციები</h3>
                        <p class="text-xs md:text-base text-gray-700 dark:text-gray-300 leading-relaxed">სერტიფიკატის მიღებისთვის საჭირო სამშენებლო რეგულაციების, კანონების დადგენილებებისა და კოდექსების ბაზა</p>
                    </div>
                </a>

                <!-- Card 5 -->
                <a href="{{ route('terms-and-conditions') }}" wire:navigate class="group bg-white dark:bg-gray-800/50 p-4 md:p-8 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100 dark:border-gray-700/50 backdrop-blur-sm relative overflow-hidden h-full">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-500/5 to-primary-500/0 dark:from-primary-400/10 dark:to-primary-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-10 h-10 md:w-14 md:h-14 bg-primary-100 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400 rounded-xl mb-3 md:mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-file-contract text-lg md:text-2xl"></i>
                        </div>
                        <h3 class="text-base md:text-xl font-bold text-gray-900 dark:text-white mb-1.5 md:mb-4 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">წესები და პირობები</h3>
                        <p class="text-xs md:text-base text-gray-700 dark:text-gray-300 leading-relaxed">სერტიფიკატის მიღების წესებისა და პირობების დეტალური განმარტებები და საგამოცდო პირობების აღწერა</p>
                    </div>
                </a>

                <!-- Card 6 -->
                <a href="{{ route('certificated-specialists') }}" wire:navigate class="group bg-white dark:bg-gray-800/50 p-4 md:p-8 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100 dark:border-gray-700/50 backdrop-blur-sm relative overflow-hidden h-full">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-500/5 to-primary-500/0 dark:from-primary-400/10 dark:to-primary-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-10 h-10 md:w-14 md:h-14 bg-primary-100 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400 rounded-xl mb-3 md:mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-users text-lg md:text-2xl"></i>
                        </div>
                        <h3 class="text-base md:text-xl font-bold text-gray-900 dark:text-white mb-1.5 md:mb-4 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">სერტიფიცირებული სპეციალისტები</h3>
                        <p class="text-xs md:text-base text-gray-700 dark:text-gray-300 leading-relaxed">სპეციალისტების მონაცემთა ბაზა გაძლევთ საშუალებას მოიძიოთ და დაუკავშირდეთ სერტიფიცირებულ არქიტექტორებს</p>
                    </div>
                </a>
                @php
                    $user = auth()->user();
                    if($user)
                    {
                        $isPremium = $user->hasActiveSubscription();
                    }
                    else
                    {
                        $isPremium = false;
                    }
                @endphp
                <!-- Video Lessons Card -->
                <button onclick="{{ $isPremium ? 'window.location.href=\''.route('tutorials').'\'' : 'showPremiumAlert()' }}" class="group bg-gradient-to-br from-amber-100 to-amber-200 dark:bg-gradient-to-br dark:from-amber-700/40 dark:to-amber-600/30 p-4 md:p-8 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border border-amber-200 dark:border-amber-600/50 backdrop-blur-sm relative overflow-hidden h-full cursor-pointer text-left">
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-500/10 to-amber-600/5 dark:from-amber-400/15 dark:to-amber-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <!-- Premium Badge -->
                    <div class="absolute top-3 right-3 px-3 py-1 bg-gradient-to-r from-amber-500 to-amber-600 text-white text-xs font-medium rounded-full shadow-md flex items-center gap-1.5">
                        <i class="fas fa-crown"></i>
                        <span>ფასიაინი</span>
                    </div>

                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-10 h-10 md:w-14 md:h-14 bg-amber-100 dark:bg-amber-800/50 text-amber-600 dark:text-amber-300 rounded-xl mb-3 md:mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-video text-lg md:text-2xl"></i>
                        </div>
                        <h3 class="text-base md:text-xl font-bold text-gray-900 dark:text-white mb-1.5 md:mb-4 group-hover:text-amber-600 dark:group-hover:text-amber-300 transition-colors">ვიდეო გაკვეთილები</h3>
                        <p class="text-xs md:text-base text-gray-700 dark:text-gray-300 leading-relaxed">ფასიანი სერვისი, რომელიც წარმოადგენს აუდიო/ვიდეო მასალის კრებულს, არქიტექტორების გადასამზადებლად</p>
                    </div>
                </button>

                <!-- Card 7 -->
                <button onclick="{{ $isPremium ? 'window.location.href=\''.route('questions').'\'' : 'showPremiumAlert()' }}" class="group bg-gradient-to-br from-amber-100 to-amber-200 dark:bg-gradient-to-br dark:from-amber-700/40 dark:to-amber-600/30 p-4 md:p-8 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border border-amber-200 dark:border-amber-600/50 backdrop-blur-sm relative overflow-hidden h-full cursor-pointer text-left">
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-500/10 to-amber-600/5 dark:from-amber-400/15 dark:to-amber-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    <!-- Premium Badge -->
                    <div class="absolute top-3 right-3 px-3 py-1 bg-gradient-to-r from-amber-500 to-amber-600 text-white text-xs font-medium rounded-full shadow-md flex items-center gap-1.5">
                        <i class="fas fa-crown"></i>
                        <span>ფასიაინი</span>
                    </div>

                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-10 h-10 md:w-14 md:h-14 bg-amber-100 dark:bg-amber-800/50 text-amber-600 dark:text-amber-300 rounded-xl mb-3 md:mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-clipboard-list text-lg md:text-2xl"></i>
                        </div>
                        <h3 class="text-base md:text-xl font-bold text-gray-900 dark:text-white mb-1.5 md:mb-4 group-hover:text-amber-600 dark:group-hover:text-amber-300 transition-colors">საგამოცდო ტესტები</h3>
                        <p class="text-xs md:text-base text-gray-700 dark:text-gray-300 leading-relaxed">ფასიანი სერვისი, რომელიც იძლევა საგამოცდო საკითხების შესწავლის საშუალებას, რათა შეძლოთ საგამოცდო ტესტების წარმატებით ჩაბარება</p>
                    </div>
                </button>
                <!-- Card 8 -->
                <button onclick="{{ $isPremium ? 'window.location.href=\''.route('workspace').'\'' : 'showPremiumAlert()' }}" class="group bg-gradient-to-br from-amber-100 to-amber-200 dark:bg-gradient-to-br dark:from-amber-700/40 dark:to-amber-600/30 p-4 md:p-8 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border border-amber-200 dark:border-amber-600/50 backdrop-blur-sm relative overflow-hidden h-full cursor-pointer text-left">
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-500/10 to-amber-600/5 dark:from-amber-400/15 dark:to-amber-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>


                    <!-- Premium Badge -->
                    <div class="absolute top-3 right-3 px-3 py-1 bg-gradient-to-r from-amber-500 to-amber-600 text-white text-xs font-medium rounded-full shadow-md flex items-center gap-1.5">
                        <i class="fas fa-crown"></i>
                        <span>ფასიაინი</span>
                    </div>

                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-10 h-10 md:w-14 md:h-14 bg-amber-100 dark:bg-amber-800/50 text-amber-600 dark:text-amber-300 rounded-xl mb-3 md:mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-user-graduate text-lg md:text-2xl"></i>
                        </div>
                        <h3 class="text-base md:text-xl font-bold text-gray-900 dark:text-white mb-1.5 md:mb-4 group-hover:text-amber-600 dark:group-hover:text-amber-300 transition-colors">სიმულაციური გამოცდა</h3>
                        <p class="text-xs md:text-base text-gray-700 dark:text-gray-300 leading-relaxed">ფასიანი სერვისი, სადაც შეგიძლიათ განსაზღვროთ თქვენი ცოდნის ხარისხი და შესაძლებლობა ოფიციალური გამოცდის ჩაბარებისა</p>
                    </div>
                </button>
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
                        <a href="{{ route('pricing') }}" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-gradient-to-r from-primary-500 to-primary-600 text-base font-medium text-white hover:from-primary-600 hover:to-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:ml-3 sm:w-auto sm:text-sm transition-all hover:scale-105">
                            <span class="flex items-center">
                                <i class="fas fa-gem mr-2 animate-pulse"></i>
                                ნახეთ ფასები
                            </span>
                        </a>
                        <button type="button" onclick="closePremiumAlert()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-800 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-all">
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
