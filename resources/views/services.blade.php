<x-layout>
    <!-- ====== Services Section Start -->
    <div class="relative overflow-hidden">
        <div class="container">
            <div class="-mx-4 flex flex-wrap items-center">
                <div class="w-full px-4 py-10">
                    <div class="wow fadeInUp mx-auto max-w-[780px] text-center" data-wow-delay=".2s">
                        <h1 class="mb-6 text-3xl font-bold leading-snug text-gray-900 dark:text-white sm:text-4xl sm:leading-snug lg:text-5xl lg:leading-[1.2]">
                            ჩვენი სერვისები
                        </h1>
                        <p class="mx-auto mb-9 max-w-[600px] text-base font-medium text-gray-600 dark:text-gray-300 sm:text-lg sm:leading-[1.44]">
                            აირჩიეთ თქვენთვის სასურველი სერვისი
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ====== Services Section End -->

    <!-- ====== Services Cards Section Start -->
    <div>
        <div class="container">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <!-- Practice Tests Card -->
                <div class="bg-white dark:bg-dark-2 rounded-xl shadow-lg overflow-hidden transition-transform hover:scale-105">
                    <div class="h-48 overflow-hidden">
                        <img src="https://daily.jstor.org/wp-content/uploads/2015/05/standardizedtests.jpg" alt="Practice Tests" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">ტესტები</h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            მოემზადეთ გამოცდისთვის ჩვენი მრავალფეროვანი ტესტების საშუალებით. პრაქტიკული ტესტები შექმნილია რეალური გამოცდის მსგავსად და მოიცავს ყველა საჭირო თემას.
                        </p>
                        <a href="/questions" wire:navigate class="inline-block bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary-dark transition-colors">
                            დაწყება
                        </a>
                    </div>
                </div>

                <!-- Exam Simulation Card -->
                <div class="bg-white dark:bg-dark-2 rounded-xl shadow-lg overflow-hidden transition-transform hover:scale-105">
                    <div class="h-48 overflow-hidden">
                        <img src="https://admissions.rochester.edu/blog/wp-content/uploads/2015/08/test.png" alt="Exam Simulation" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">გამოცდის სიმულაცია</h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            გაიარეთ სრული გამოცდის სიმულაცია რეალური გამოცდის იდენტურ გარემოში. დროის ლიმიტი, კითხვების რაოდენობა და სირთულე შეესაბამება რეალურ გამოცდას.
                        </p>
                        <a href="/exam" wire:navigate class="inline-block bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary-dark transition-colors">
                            სიმულაცია
                        </a>
                    </div>
                </div>

                <!-- Video Tutorials Card -->
                <div class="bg-white dark:bg-dark-2 rounded-xl shadow-lg overflow-hidden transition-transform hover:scale-105">
                    <div class="h-48 overflow-hidden">
                        <img src="https://www.thedvigroup.com/wp-content/uploads/2023/08/Benefits-of-Video-Tutorials-Distance-Learner-Watching-Video-166191408_m_normal_none-1.jpg" alt="Video Tutorials" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">ვიდეო გაკვეთილები</h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            უყურეთ დეტალურ ვიდეო გაკვეთილებს ნებისმიერ დროს. ჩვენი ექსპერტები გაგიზიარებენ თავიანთ ცოდნას და გამოცდილებას ყველა მნიშვნელოვან თემაზე.
                        </p>
                        <a href="/tutorials" wire:navigate class="inline-block bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary-dark transition-colors">
                            ნახვა
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- ====== Services Cards Section End -->
</x-layout>
