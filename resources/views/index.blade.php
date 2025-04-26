<x-layout>
    <!-- Features Section -->
    <section class="py-6 md:py-16 bg-white dark:bg-gray-900">
        <div class="max-w-[120rem] mx-auto px-3 sm:px-6 lg:px-12">
            <h1 class="text-2xl md:text-4xl font-bold pb-6 text-gray-900 text-center dark:text-white mb-6">საქართველოს პროფესიული სერტიფიცირების ინსტიტუტი</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8 w-full px-4 sm:px-6 lg:px-8">
                <!-- Jobs Card -->
                <a href="{{ route('jobs') }}" class="group bg-white dark:bg-gray-800/50 p-4 md:p-8 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100 dark:border-gray-700/50 backdrop-blur-sm relative overflow-hidden cursor-pointer h-full">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-500/5 to-primary-500/0 dark:from-primary-400/10 dark:to-primary-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-10 h-10 md:w-14 md:h-14 bg-primary-100 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400 rounded-xl mb-3 md:mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-briefcase text-lg md:text-2xl"></i>
                        </div>
                        <h3 class="text-base md:text-xl font-bold text-gray-900 dark:text-white mb-1.5 md:mb-4 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">ვაკანსიები არქიტექტორებისთვის</h3>
                        <p class="text-xs md:text-base text-gray-700 dark:text-gray-300 leading-relaxed">შეგიძლიათ მოიძიოთ ან შესთავაზოთ სამუშაო სამშენებლო სფეროს სხვადასხვა დარგის სპეციალისტებს</p>
                    </div>
                </a>

                <!-- Exam Tests Card -->
                <div class="group bg-white dark:bg-gray-800/50 p-4 md:p-8 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100 dark:border-gray-700/50 backdrop-blur-sm relative overflow-hidden h-full">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-500/5 to-primary-500/0 dark:from-primary-400/10 dark:to-primary-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-10 h-10 md:w-14 md:h-14 bg-primary-100 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400 rounded-xl mb-3 md:mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-newspaper text-lg md:text-2xl"></i>
                        </div>
                        <h3 class="text-base md:text-xl font-bold text-gray-900 dark:text-white mb-1.5 md:mb-4 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">სიახლე</h3>
                        <p class="text-xs md:text-base text-gray-700 dark:text-gray-300 leading-relaxed">სამშენებლო სექტორში არსებული სიახლეების, რეგულაციებში შეტანილი ცვლილებებისა და განახლებების საინფორმაციო ბაზა</p>
                    </div>
                </div>

                <!-- Simulation Exam Card -->
                <a href="{{ route('regulations') }}" class="group bg-white dark:bg-gray-800/50 p-4 md:p-8 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100 dark:border-gray-700/50 backdrop-blur-sm relative overflow-hidden h-full">
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
                <a href="{{ route('terms-and-conditions') }}" class="group bg-white dark:bg-gray-800/50 p-4 md:p-8 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100 dark:border-gray-700/50 backdrop-blur-sm relative overflow-hidden h-full">
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
                <a href="{{ route('certificated-specialists') }}" class="group bg-white dark:bg-gray-800/50 p-4 md:p-8 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100 dark:border-gray-700/50 backdrop-blur-sm relative overflow-hidden h-full">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-500/5 to-primary-500/0 dark:from-primary-400/10 dark:to-primary-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-10 h-10 md:w-14 md:h-14 bg-primary-100 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400 rounded-xl mb-3 md:mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-users text-lg md:text-2xl"></i>
                        </div>
                        <h3 class="text-base md:text-xl font-bold text-gray-900 dark:text-white mb-1.5 md:mb-4 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">სერტიფიცირებული სპეციალისტები</h3>
                        <p class="text-xs md:text-base text-gray-700 dark:text-gray-300 leading-relaxed">სპეციალისტების მონაცემთა ბაზა გაძლევთ საშუალებას მოიძიოთ და დაუკავშირდეთ სერტიფიცირებულ არქიტექტორებს</p>
                    </div>
                </a>

                <!-- Video Lessons Card -->
                <a href="{{ route('tutorials') }}" class="group bg-white dark:bg-gray-800/50 p-4 md:p-8 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100 dark:border-gray-700/50 backdrop-blur-sm relative overflow-hidden h-full">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-500/5 to-primary-500/0 dark:from-primary-400/10 dark:to-primary-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <!-- Premium Badge -->
                    <div class="absolute top-3 right-3 px-3 py-1 bg-gradient-to-r from-amber-500 to-amber-600 text-white text-xs font-medium rounded-full shadow-md flex items-center gap-1.5">
                        <i class="fas fa-crown"></i>
                        <span>ფასიაინი</span>
                    </div>
                    
                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-10 h-10 md:w-14 md:h-14 bg-primary-100 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400 rounded-xl mb-3 md:mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-video text-lg md:text-2xl"></i>
                        </div>
                        <h3 class="text-base md:text-xl font-bold text-gray-900 dark:text-white mb-1.5 md:mb-4 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">ვიდეო გაკვეთილები</h3>
                        <p class="text-xs md:text-base text-gray-700 dark:text-gray-300 leading-relaxed">ფასიანი სერვისი, რომელიც წარმოადგენს აუდიო/ვიდეო მასალის კრებულს, არქიტექტორების გადასამზადებლად</p>
                    </div>
                </a>

                <!-- Card 7 -->
                <div class="group bg-white dark:bg-gray-800/50 p-4 md:p-8 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100 dark:border-gray-700/50 backdrop-blur-sm relative overflow-hidden h-full">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-500/5 to-primary-500/0 dark:from-primary-400/10 dark:to-primary-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <!-- Premium Badge -->
                    <div class="absolute top-3 right-3 px-3 py-1 bg-gradient-to-r from-amber-500 to-amber-600 text-white text-xs font-medium rounded-full shadow-md flex items-center gap-1.5">
                        <i class="fas fa-crown"></i>
                        <span>ფასიაინი</span>
                    </div>
                    
                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-10 h-10 md:w-14 md:h-14 bg-primary-100 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400 rounded-xl mb-3 md:mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-clipboard-list text-lg md:text-2xl"></i>
                        </div>
                        <h3 class="text-base md:text-xl font-bold text-gray-900 dark:text-white mb-1.5 md:mb-4 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">საგამოცდო ტესტები</h3>
                        <p class="text-xs md:text-base text-gray-700 dark:text-gray-300 leading-relaxed">ფასიანი სერვისი, რომელიც იძლევა საგამოცდო საკითხების შესწავლის საშუალებას, რათა შეძლოთ საგამოცდო ტესტების წარმატებით ჩაბარება</p>
                    </div>
                </div>

                <!-- Card 8 -->
                <a href="{{ route('dashboard') }}" class="group bg-white dark:bg-gray-800/50 p-4 md:p-8 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100 dark:border-gray-700/50 backdrop-blur-sm relative overflow-hidden h-full">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-500/5 to-primary-500/0 dark:from-primary-400/10 dark:to-primary-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <!-- Premium Badge -->
                    <div class="absolute top-3 right-3 px-3 py-1 bg-gradient-to-r from-amber-500 to-amber-600 text-white text-xs font-medium rounded-full shadow-md flex items-center gap-1.5">
                        <i class="fas fa-crown"></i>
                        <span>ფასიაინი</span>
                    </div>
                    
                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-10 h-10 md:w-14 md:h-14 bg-primary-100 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400 rounded-xl mb-3 md:mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-user-graduate text-lg md:text-2xl"></i>
                        </div>
                        <h3 class="text-base md:text-xl font-bold text-gray-900 dark:text-white mb-1.5 md:mb-4 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">სიმულაციური გამოცდა</h3>
                        <p class="text-xs md:text-base text-gray-700 dark:text-gray-300 leading-relaxed">ფასიანი სერვისი, სადაც შეგიძლიათ განსაზღვროთ თქვენი ცოდნის ხარისხი და შესაძლებლობა ოფიციალური გამოცდის ჩაბარებისა</p>
                    </div>
                </a>
            </div>
        </div>
    </section>
</x-layout>
