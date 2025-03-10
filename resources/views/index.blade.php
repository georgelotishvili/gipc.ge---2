<x-layout>
    <!-- Hero Section Start -->
    <section class="relative overflow-hidden pt-24 dark:bg-dark">
        <div class="absolute inset-0 bg-white dark:bg-dark -z-10"></div>
        <div class="absolute inset-0 opacity-30 -z-10 bg-pattern dark:opacity-10"></div>
        
        <!-- Banner Slider -->
        <div x-data="{ 
            currentSlide: parseInt(localStorage.getItem('currentSlide')) || 0,
            slides: [
                { image: 'https://picsum.photos/1600/900?random=1', title: 'პროფესიული სერტიფიცირება', subtitle: 'საერთაშორისო სტანდარტებით' },
                { image: 'https://picsum.photos/1600/900?random=2', title: 'ISO სტანდარტების შესაბამისად', subtitle: 'კვალიფიკაციის ამაღლება' },
                { image: 'https://picsum.photos/1600/900?random=3', title: 'საერთაშორისო გამოცდილება', subtitle: 'პროფესიონალთა გუნდი' },
                { image: 'https://picsum.photos/1600/900?random=4', title: 'სერტიფიცირების პროგრამები', subtitle: 'თანამედროვე მიდგომები' },
                { image: 'https://picsum.photos/1600/900?random=5', title: 'უწყვეტი განათლება', subtitle: 'პროფესიული ზრდა' },
                { image: 'https://picsum.photos/1600/900?random=6', title: 'ხარისხის გარანტია', subtitle: 'საერთაშორისო აღიარება' },
                { image: 'https://picsum.photos/1600/900?random=7', title: 'ინოვაციური სწავლება', subtitle: 'თანამედროვე მეთოდები' },
                { image: 'https://picsum.photos/1600/900?random=8', title: 'პრაქტიკული გამოცდილება', subtitle: 'რეალური პროექტები' },
                { image: 'https://picsum.photos/1600/900?random=9', title: 'კარიერული წინსვლა', subtitle: 'პროფესიული განვითარება' },
                { image: 'https://picsum.photos/1600/900?random=10', title: 'გლობალური სტანდარტები', subtitle: 'ლოკალური ექსპერტიზა' }
            ]
         }"
         x-init="
            setInterval(() => { 
                currentSlide = (currentSlide + 1) % slides.length;
                localStorage.setItem('currentSlide', currentSlide);
            }, 4000);
            $watch('currentSlide', value => localStorage.setItem('currentSlide', value));"
         class="relative max-w-[120rem] mx-auto mb-16">
            
            <!-- Slides Container -->
            <div class="relative h-[300px] overflow-hidden rounded-3xl">
                <template x-for="(slide, index) in slides" :key="index">
                    <div x-show="currentSlide === index"
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 transform translate-x-full"
                         x-transition:enter-end="opacity-100 transform translate-x-0"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100 transform translate-x-0"
                         x-transition:leave-end="opacity-0 transform -translate-x-full"
                         class="absolute inset-0">
                        <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-black/30"></div>
                        <img :src="slide.image" :alt="slide.title" 
                             class="w-full h-full object-cover">
                        <div class="absolute bottom-0 left-0 right-0 p-12 text-white">
                            <h2 class="text-4xl font-bold mb-4" x-text="slide.title"></h2>
                            <p class="text-xl" x-text="slide.subtitle"></p>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Navigation Dots -->
            <!-- <div class="flex justify-center gap-3 mt-6">
                <template x-for="(slide, index) in slides" :key="index">
                    <button @click="currentSlide = index"
                            :class="{ 'bg-primary-600': currentSlide === index, 'bg-gray-300 dark:bg-gray-700': currentSlide !== index }"
                            class="w-3 h-3 rounded-full transition-colors duration-200">
                    </button>
                </template>
            </div> -->
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-6 md:py-16 bg-white dark:bg-gray-900">
        <div class="max-w-[120rem] mx-auto px-3 sm:px-6 lg:px-12">
            <!-- <div class="text-center mb-10 md:mb-16">
                <div class="inline-block mb-2 md:mb-5 px-3 md:px-6 py-1 md:py-2 bg-primary-100 text-primary-600 rounded-full text-xs md:text-sm font-semibold tracking-wide">
                    პროფესიული განვითარება
                </div>
                <h2 class="text-xl md:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-2 md:mb-5 leading-tight">
                    სერტიფიცირების პროცესი
                </h2>
                <p class="text-sm md:text-lg text-gray-700 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed px-2 md:px-4">
                    ჩვენი სერტიფიცირების პროცესი შემუშავებულია საერთაშორისო სტანდარტების შესაბამისად და უზრუნველყოფს მაღალ პროფესიულ დონეს
                </p>
            </div> -->

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8 w-full px-4 sm:px-6 lg:px-8" x-data="{ 
                showJobs: false,
                activeFilter: 'all',
                jobs: [
                    { 
                        title: 'არქიტექტორი',
                        company: 'Construction Pro',
                        location: 'თბილისი',
                        type: 'სრული განაკვეთი',
                        salary: '2500-3500 ₾',
                        description: 'გვესაჭიროება გამოცდილი არქიტექტორი კომერციული პროექტებისთვის...',
                        posted: '2 დღის წინ',
                        jobType: 'hiring'
                    },
                    { 
                        title: 'პროექტის მენეჯერი',
                        company: 'Build Corp',
                        location: 'ბათუმი',
                        type: 'სრული განაკვეთი',
                        salary: '3000-4500 ₾',
                        description: 'ვეძებთ გამოცდილ პროექტის მენეჯერს მსხვილი სამშენებლო პროექტებისთვის...',
                        posted: '3 დღის წინ',
                        jobType: 'hiring'
                    },
                    { 
                        title: 'ინტერიერის დიზაინერი',
                        company: 'Design Studio',
                        location: 'თბილისი',
                        type: 'ნახევარი განაკვეთი',
                        salary: '1500-2000 ₾',
                        description: 'გვჭირდება კრეატიული ინტერიერის დიზაინერი...',
                        posted: '1 დღის წინ',
                        jobType: 'hiring'
                    },
                    { 
                        title: 'კონსტრუქტორი',
                        company: 'Engineering Solutions',
                        location: 'ქუთაისი',
                        type: 'სრული განაკვეთი',
                        salary: '2800-3800 ₾',
                        description: 'ვეძებთ გამოცდილ კონსტრუქტორს სამოქალაქო მშენებლობის პროექტებისთვის...',
                        posted: '5 დღის წინ',
                        jobType: 'hiring'
                    },
                    { 
                        title: 'ლანდშაფტის არქიტექტორი',
                        company: 'Green Spaces',
                        location: 'თბილისი',
                        type: 'სრული განაკვეთი',
                        salary: '2000-3000 ₾',
                        description: 'გვესაჭიროება კრეატიული ლანდშაფტის არქიტექტორი...',
                        posted: '4 დღის წინ',
                        jobType: 'hiring'
                    },
                    { 
                        title: 'გამოცდილი არქიტექტორი',
                        company: 'დამოუკიდებელი სპეციალისტი',
                        location: 'თბილისი',
                        type: 'სრული განაკვეთი',
                        salary: '3500-4500 ₾',
                        description: '10 წლიანი გამოცდილება არქიტექტურულ დაგეგმარებაში...',
                        posted: '2 დღის წინ',
                        jobType: 'seeking'
                    },
                    { 
                        title: 'ინტერიერის დიზაინერი',
                        company: 'თვითდასაქმებული',
                        location: 'თბილისი',
                        type: 'ნებისმიერი',
                        salary: '2000-3000 ₾',
                        description: '5 წლიანი გამოცდილება ინტერიერის დიზაინში...',
                        posted: '1 დღის წინ',
                        jobType: 'seeking'
                    },
                    { 
                        title: 'კონსტრუქტორი',
                        company: 'დამოუკიდებელი ინჟინერი',
                        location: 'ბათუმი',
                        type: 'სრული განაკვეთი',
                        salary: '3000-4000 ₾',
                        description: '8 წლიანი გამოცდილება კონსტრუქციულ გაანგარიშებებში...',
                        posted: '3 დღის წინ',
                        jobType: 'seeking'
                    },
                    { 
                        title: '3D მოდელირების სპეციალისტი',
                        company: 'ფრილანსერი',
                        location: 'დისტანციური',
                        type: 'ნებისმიერი',
                        salary: '2500-3500 ₾',
                        description: 'პროფესიონალი 3D მოდელირების სპეციალისტი ეძებს სამსახურს...',
                        posted: '4 დღის წინ',
                        jobType: 'seeking'
                    },
                    { 
                        title: 'პროექტის ხელმძღვანელი',
                        company: 'დამოუკიდებელი მენეჯერი',
                        location: 'თბილისი',
                        type: 'სრული განაკვეთი',
                        salary: '4000-5000 ₾',
                        description: '12 წლიანი გამოცდილება პროექტების მართვაში...',
                        posted: '5 დღის წინ',
                        jobType: 'seeking'
                    }
                ]
            }">
                <!-- Jobs Card -->
                <div :class="{ 'xl:col-span-4 lg:col-span-3 md:col-span-2 transition-all duration-300': showJobs }">
                    <div x-show="!showJobs" @click="showJobs = true" class="group bg-white dark:bg-gray-800/50 p-4 md:p-8 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100 dark:border-gray-700/50 backdrop-blur-sm relative overflow-hidden cursor-pointer h-full">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary-500/5 to-primary-500/0 dark:from-primary-400/10 dark:to-primary-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        
                        <div class="relative z-10">
                            <div class="inline-flex items-center justify-center w-10 h-10 md:w-14 md:h-14 bg-primary-100 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400 rounded-xl mb-3 md:mb-6 group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-briefcase text-lg md:text-2xl"></i>
                            </div>
                            <h3 class="text-base md:text-xl font-bold text-gray-900 dark:text-white mb-1.5 md:mb-4 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">ვაკანსიები არქიტექტორებისთვის</h3>
                            <p class="text-xs md:text-base text-gray-700 dark:text-gray-300 leading-relaxed">შეგიძლიათ მოიძიოთ ან შესთავაზოთ სამუშაო სამშენებლო სფეროს სხვადასხვა დარგის სპეციალისტებს</p>
                        </div>
                    </div>

                    <x-job-listings />
                </div>

                <!-- Exam Tests Card -->
                <div x-show="!showJobs" class="group bg-white dark:bg-gray-800/50 p-4 md:p-8 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100 dark:border-gray-700/50 backdrop-blur-sm relative overflow-hidden h-full">
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
                <div x-show="!showJobs" class="group bg-white dark:bg-gray-800/50 p-4 md:p-8 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100 dark:border-gray-700/50 backdrop-blur-sm relative overflow-hidden h-full">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-500/5 to-primary-500/0 dark:from-primary-400/10 dark:to-primary-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-10 h-10 md:w-14 md:h-14 bg-primary-100 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400 rounded-xl mb-3 md:mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-book text-lg md:text-2xl"></i>
                        </div>
                        <h3 class="text-base md:text-xl font-bold text-gray-900 dark:text-white mb-1.5 md:mb-4 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">სამშენებლო რეგულაციები</h3>
                        <p class="text-xs md:text-base text-gray-700 dark:text-gray-300 leading-relaxed">სერტიფიკატის მიღებისთვის საჭირო სამშენებლო რეგულაციების, კანონების დადგენილებებისა და კოდექსების ბაზა</p>
                    </div>
                </div>

                <!-- Card 5 -->
                <div x-show="!showJobs" class="group bg-white dark:bg-gray-800/50 p-4 md:p-8 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100 dark:border-gray-700/50 backdrop-blur-sm relative overflow-hidden h-full">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-500/5 to-primary-500/0 dark:from-primary-400/10 dark:to-primary-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-10 h-10 md:w-14 md:h-14 bg-primary-100 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400 rounded-xl mb-3 md:mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-file-contract text-lg md:text-2xl"></i>
                        </div>
                        <h3 class="text-base md:text-xl font-bold text-gray-900 dark:text-white mb-1.5 md:mb-4 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">წესები და პირობები</h3>
                        <p class="text-xs md:text-base text-gray-700 dark:text-gray-300 leading-relaxed">სერტიფიკატის მიღების წესებისა და პირობების დეტალური განმარტებები და საგამოცდო პირობების აღწერა</p>
                    </div>
                </div>

                
                <!-- Card 6 -->
                <div x-show="!showJobs" class="group bg-white dark:bg-gray-800/50 p-4 md:p-8 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100 dark:border-gray-700/50 backdrop-blur-sm relative overflow-hidden h-full">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-500/5 to-primary-500/0 dark:from-primary-400/10 dark:to-primary-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-10 h-10 md:w-14 md:h-14 bg-primary-100 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400 rounded-xl mb-3 md:mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-users text-lg md:text-2xl"></i>
                        </div>
                        <h3 class="text-base md:text-xl font-bold text-gray-900 dark:text-white mb-1.5 md:mb-4 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">სერტიფიცირებული სპეციალისტები</h3>
                        <p class="text-xs md:text-base text-gray-700 dark:text-gray-300 leading-relaxed">სპეციალისტების მონაცემთა ბაზა გაძლევთ საშუალებას მოიძიოთ და დაუკავშირდეთ სერტიფიცირებულ არქიტექტორებს</p>
                    </div>
                </div>
                <!-- Video Lessons Card -->
                <div x-show="!showJobs" class="group bg-white dark:bg-gray-800/50 p-4 md:p-8 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100 dark:border-gray-700/50 backdrop-blur-sm relative overflow-hidden h-full">
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
                </div>

                <!-- Card 7 -->
                <div x-show="!showJobs" class="group bg-white dark:bg-gray-800/50 p-4 md:p-8 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100 dark:border-gray-700/50 backdrop-blur-sm relative overflow-hidden h-full">
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
                <div x-show="!showJobs" class="group bg-white dark:bg-gray-800/50 p-4 md:p-8 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100 dark:border-gray-700/50 backdrop-blur-sm relative overflow-hidden h-full">
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
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-4">
        <div class="max-w-[120rem] mx-auto px-2 sm:px-8 lg:px-12">
            <div class="bg-gradient-to-br from-primary-600/90 to-primary-500/90 dark:from-[#0A1A2F] dark:to-[#0F2744] rounded-2xl p-4 sm:p-8 shadow-xl relative overflow-hidden group">
                <!-- Animated Background Elements -->
                <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent dark:from-white/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="absolute inset-0 bg-[url('/img/grid-pattern.svg')] opacity-10 dark:opacity-5"></div>
                
                <!-- Glowing Orbs -->
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-primary-400/50 dark:bg-blue-500/20 rounded-full mix-blend-multiply dark:mix-blend-soft-light filter blur-3xl opacity-30 dark:opacity-20"></div>
                <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-primary-400/50 dark:bg-blue-500/20 rounded-full mix-blend-multiply dark:mix-blend-soft-light filter blur-3xl opacity-30 dark:opacity-20"></div>

                <div class="relative z-10">
                    <div class="max-w-3xl mx-auto text-center">
                        <h2 class="text-xl sm:text-4xl font-bold text-white mb-6 drop-shadow-sm">
                            აიმაღლეთ პროფესიული კვალიფიკაცია
                        </h2>
                        <p class="text-md sm:text-xl text-white/90 dark:text-white/80 mb-10 leading-relaxed">
                            დაიწყეთ თქვენი პროფესიული განვითარების გზა GIPC-სთან ერთად და მიიღეთ საერთაშორისოდ აღიარებული სერტიფიკატი
                        </p>
                        <a href="#" class="group/btn bg-white/95 dark:bg-white/90 text-primary-600 dark:text-[#0A1A2F] px-10 py-4 rounded-lg hover:bg-white dark:hover:bg-white transition-all duration-300 inline-flex items-center shadow-lg shadow-primary-950/20 dark:shadow-black/20 font-semibold relative overflow-hidden">
                            <span class="relative z-10 flex items-center">
                                უფასო კონსულტაცია 
                                <i class="fas fa-arrow-right ml-3 transform group-hover/btn:translate-x-1 transition-transform"></i>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-gray-50 to-white opacity-0 group-hover/btn:opacity-100 transition-opacity duration-300"></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
