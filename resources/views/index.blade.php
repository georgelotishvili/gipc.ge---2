<x-layout>
    <!-- Features Section -->
    <section class="pt-6 pb-6 md:pt-8 md:pb-16 dark:bg-gradient-to-br dark:from-dark-indigo-50 dark:via-dark-indigo-100 dark:to-dark-indigo-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl md:text-4xl font-semibold text-gray-900 text-center dark:text-gray-100 mb-4">საქართველოს პროფესიული სერტიფიცირების ინსტიტუტი</h1>
            <p class="w-full mb-8 text-sm sm:text-base md:text-lg leading-7 md:leading-8 text-gray-600 dark:text-gray-300 text-justify">
                ვებგვერდი შექმნილია არქიტექტორთა პროფესიული კვალიფიკაციის ამაღლებისთვის. პლატფორმაზე განთავსებულია სასწავლო ვიდეომასალა, რომელიც არქიტექტორებს სამშენებლო რეგულაციების შესწავლაში ეხმარება, ასევე სიმულაციური გამოცდა, რომელიც მაქსიმალურად უახლოვდება სასერტიფიკაციო გამოცდის ფორმატს. ვებგვერდზე წარმოდგენილია საგამოცდო საკითხებიც, რომლებიც შინაარსობრივად ჰგავს სასერტიფიკაციო გამოცდის საკითხებს, თუმცა არ წარმოადგენს მათ ზუსტ ასლს. გამოიწერეთ კურსი, აიმაღლეთ კვალიფიკაცია და დარწმუნდით, რომ მზად ხართ სასერტიფიკაციო გამოცდის ჩასაბარებლად. გისურვებთ წარმატებებს.
            </p>
            @php
                $cards = [
                    [
                        'route' => route('jobs'),
                        'title' => 'ვაკანსიები არქიტექტორებისთვის',
                        'description' => 'შეგიძლიათ მოიძიოთ ან შესთავაზოთ სამუშაო სამშენებლო სფეროს სხვადასხვა დარგის სპეციალისტებს',
                        'icon' => 'briefcase',
                        'image' => 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=900&q=80',
                        'premium' => false,
                        'cta' => 'ვაკანსიებზე გადასვლა',
                    ],
                    [
                        'route' => route('regulations'),
                        'title' => 'სამშენებლო რეგულაციები',
                        'description' => 'სერტიფიკატის მიღებისთვის საჭირო სამშენებლო რეგულაციების, კანონების დადგენილებებისა და კოდექსების ბაზა',
                        'icon' => 'book',
                        'image' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&w=900&q=80',
                        'premium' => false,
                        'cta' => 'რეგულაციების ბაზა',
                    ],
                    [
                        'route' => route('terms-and-conditions'),
                        'title' => 'წესები და პირობები',
                        'description' => 'სერტიფიკატის მიღების წესებისა და პირობების დეტალური განმარტებები და საგამოცდო პირობების აღწერა',
                        'icon' => 'file-contract',
                        'image' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=900&q=80',
                        'premium' => false,
                        'cta' => 'პირობების გაცნობა',
                    ],
                    [
                        'route' => route('tutorials'),
                        'title' => 'ვიდეო გაკვეთილები',
                        'description' => 'ფასიანი სერვისი, რომელიც წარმოადგენს აუდიო/ვიდეო მასალის კრებულს, არქიტექტორების გადასამზადებლად',
                        'icon' => 'video',
                        'image' => 'https://www.thedvigroup.com/wp-content/uploads/2023/08/Benefits-of-Video-Tutorials-Distance-Learner-Watching-Video-166191408_m_normal_none-1.jpg',
                        'premium' => true,
                        'cta' => 'გაკვეთილების დაწყება',
                    ],
                    [
                        'route' => route('questions'),
                        'title' => 'საგამოცდო ტესტები',
                        'description' => 'ფასიანი სერვისი, რომელიც იძლევა საგამოცდო საკითხების შესწავლის საშუალებას, რათა შეძლოთ საგამოცდო ტესტების წარმატებით ჩაბარება',
                        'icon' => 'clipboard-list',
                        'image' => 'https://daily.jstor.org/wp-content/uploads/2015/05/standardizedtests.jpg',
                        'premium' => true,
                        'cta' => 'ტესტების გაცნობა',
                    ],
                    [
                        'route' => route('workspace'),
                        'title' => 'სიმულაციური გამოცდა',
                        'description' => 'ფასიანი სერვისი, სადაც შეგიძლიათ განსაზღვროთ თქვენი ცოდნის ხარისხი და შესაძლებლობა ოფიციალური გამოცდის ჩაბარებისა',
                        'icon' => 'user-graduate',
                        'image' => 'https://admissions.rochester.edu/blog/wp-content/uploads/2015/08/test.png',
                        'premium' => true,
                        'cta' => 'სიმულაციის დაწყება',
                    ],
                ];

                $user = auth()->user();
                $isPremium = $user ? $user->hasActiveSubscription() : false;
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @foreach ($cards as $card)
                    @php
                        $requiresPremium = $card['premium'] && ! $isPremium;
                        $cardHref = $requiresPremium ? '#' : $card['route'];
                    @endphp
                    <a href="{{ $cardHref }}" @if ($requiresPremium) onclick="event.preventDefault(); showPremiumAlert();" @else wire:navigate @endif class="group relative h-full">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-600 rounded-md blur opacity-20 group-hover:opacity-40 transition-all duration-500"></div>
                        <div class="relative bg-white dark:bg-[#1E293B]/[0.98] backdrop-blur-sm rounded-md shadow-xl overflow-hidden border border-gray-100/50 dark:border-indigo-500/25 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 h-full flex flex-col">
                            <div class="h-52 sm:h-48 overflow-hidden flex-shrink-0 relative">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-black/10 to-transparent z-10"></div>
                                <img src="{{ $card['image'] }}" alt="{{ $card['title'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute top-4 left-4 z-20">
                                    <div class="w-10 h-10 bg-white/75 dark:bg-white/75 backdrop-blur-sm rounded-md flex items-center justify-center border border-white/60 shadow-lg">
                                        <i class="fas fa-{{ $card['icon'] }} text-black text-lg"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="p-6 sm:p-5 lg:p-6 flex flex-col flex-grow">
                                <div class="flex items-start justify-between mb-4">
                                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ $card['title'] }}</h3>
                                    @if ($card['premium'])
                                        <div class="px-3 py-1.5 bg-gradient-to-r from-amber-500 to-amber-600 text-white text-xs font-semibold rounded-md shadow-lg flex items-center gap-1.5 flex-shrink-0">
                                            <i class="fas fa-crown text-xs"></i>
                                            <span>ფასიანი</span>
                                        </div>
                                    @endif
                                </div>
                                <p class="text-gray-600 dark:text-gray-300 mb-6 leading-relaxed flex-grow text-sm sm:text-base">{{ $card['description'] }}</p>
                                <div class="w-full inline-flex items-center justify-center px-4 py-3 sm:px-6 sm:py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-semibold rounded-md group-hover:from-indigo-600 group-hover:to-purple-700 transition-all duration-300 transform group-hover:scale-105 group-hover:shadow-lg mt-auto">
                                    <span class="text-sm sm:text-base">{{ $card['cta'] }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Premium Alert Modal -->
    <div id="premiumAlertModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-dark-indigo-50 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white dark:bg-dark-indigo-200/90 rounded-md text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full animate-fadeIn">
                <div class="relative">
                    <!-- Animated background effect -->
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="absolute -inset-4 bg-gradient-to-r from-purple-300/20 via-pink-500/10 to-purple-300/20 animate-gradient-x"></div>
                    </div>

                    <!-- Premium content -->
                    <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4 relative z-10">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-16 w-16 rounded-md bg-gradient-to-r from-purple-400 to-pink-600 sm:mx-0 sm:h-14 sm:w-14 shadow-lg relative overflow-hidden">
                                <div class="absolute inset-0 bg-purple-500 animate-pulse-slow opacity-50"></div>
                                <div class="crown-container animate-float">
                                    <i class="fas fa-crown text-white text-2xl"></i>
                                </div>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-xl leading-6 font-bold text-gray-900 dark:text-gray-100">
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

                    <div class="bg-gray-50 dark:bg-dark-indigo-300/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse relative z-10">
                        <a href="{{ route('pricing') }}" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-gradient-to-r from-primary-500 to-primary-600 text-base font-medium text-white hover:from-primary-600 hover:to-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:ml-3 sm:w-auto sm:text-sm transition-all hover:scale-105">
                            <span class="flex items-center">
                                <i class="fas fa-gem mr-2 animate-pulse"></i>
                                ნახეთ ფასები
                            </span>
                        </a>
                        <button type="button" onclick="closePremiumAlert()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-dark-indigo-400 shadow-sm px-4 py-2 bg-white dark:bg-dark-indigo-200 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-dark-indigo-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-all">
                            დახურვა
                        </button>
                    </div>

                    <!-- Decorative elements -->
                    <div class="absolute top-0 left-0 w-20 h-20 bg-gradient-to-br from-purple-300/30 to-transparent rounded-br-md"></div>
                    <div class="absolute bottom-0 right-0 w-20 h-20 bg-gradient-to-tl from-pink-300/30 to-transparent rounded-tl-md"></div>
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
