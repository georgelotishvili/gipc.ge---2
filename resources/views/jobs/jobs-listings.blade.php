<x-layout>

<!-- Main Content -->
    <div class="w-full px-4 sm:px-6 lg:px-8 py-12"
         x-data="{ 
            searchQuery: '',
            activeFilter: 'hiring',
            jobs: [
                { 
                    title: 'არქიტექტორი',
                    company: 'Construction Pro',
                    companyLogo: 'https://placehold.co/400x400?text=Construction+Pro',
                    location: 'თბილისი', 
                    type: 'სრული განაკვეთი',
                    salary: '2500-3500 ₾',
                    description: 'გვესაჭიროება გამოცდილი არქიტექტორი კომერციული პროექტებისთვის...',
                    posted: '2 დღის წინ',
                    jobType: 'hiring',
                    tags: ['AutoCAD', 'Revit', 'SketchUp', 'კომერციული პროექტირება']
                },
                { 
                    title: 'პროექტის მენეჯერი',
                    company: 'Build Corp',
                    companyLogo: 'https://placehold.co/400x400?text=Build+Corp',
                    location: 'ბათუმი',
                    type: 'სრული განაკვეთი', 
                    salary: '3000-4500 ₾',
                    description: 'ვეძებთ გამოცდილ პროექტის მენეჯერს მსხვილი სამშენებლო პროექტებისთვის...',
                    posted: '3 დღის წინ',
                    jobType: 'hiring',
                    tags: ['პროექტის მართვა', 'MS Project', 'სამშენებლო მენეჯმენტი']
                },
                { 
                    title: 'ინტერიერის დიზაინერი',
                    company: 'Design Studio',
                    companyLogo: 'https://placehold.co/400x400?text=Design+Studio',
                    location: 'თბილისი',
                    type: 'ნახევარი განაკვეთი',
                    salary: '1500-2000 ₾',
                    description: 'გვჭირდება კრეატიული ინტერიერის დიზაინერი...',
                    posted: '1 დღის წინ',
                    jobType: 'hiring',
                    tags: ['3ds Max', 'V-Ray', 'Adobe Photoshop', 'საცხოვრებელი დიზაინი']
                },
                { 
                    title: 'კონსტრუქტორი',
                    company: 'Engineering Solutions',
                    companyLogo: 'https://placehold.co/400x400?text=Engineering+Solutions',
                    location: 'ქუთაისი',
                    type: 'სრული განაკვეთი',
                    salary: '2800-3800 ₾',
                    description: 'ვეძებთ გამოცდილ კონსტრუქტორს სამოქალაქო მშენებლობის პროექტებისთვის...',
                    posted: '5 დღის წინ',
                    jobType: 'hiring',
                    tags: ['ETABS', 'SAP2000', 'AutoCAD', 'სტრუქტურული ანალიზი']
                },
                { 
                    title: 'ლანდშაფტის არქიტექტორი',
                    company: 'Green Spaces',
                    companyLogo: 'https://placehold.co/400x400?text=Green+Spaces',
                    location: 'თბილისი',
                    type: 'სრული განაკვეთი',
                    salary: '2000-3000 ₾',
                    description: 'გვესაჭიროება კრეატიული ლანდშაფტის არქიტექტორი...',
                    posted: '4 დღის წინ',
                    jobType: 'hiring',
                    tags: ['Lumion', 'SketchUp', 'გამწვანება', 'ლანდშაფტის დიზაინი']
                },
                { 
                    title: 'გამოცდილი არქიტექტორი',
                    company: 'დამოუკიდებელი სპეციალისტი',
                    avatar: 'https://placehold.co/400x400?text=User1',
                    location: 'თბილისი',
                    type: 'სრული განაკვეთი',
                    salary: '3500-4500 ₾',
                    description: '10 წლიანი გამოცდილება არქიტექტურულ დაგეგმარებაში...',
                    posted: '2 დღის წინ',
                    jobType: 'seeking',
                    tags: ['BIM', 'Revit', 'ArchiCAD', 'მრავალსართულიანი']
                },
                { 
                    title: 'ინტერიერის დიზაინერი',
                    company: 'თვითდასაქმებული',
                    avatar: 'https://placehold.co/400x400?text=User2',
                    location: 'თბილისი',
                    type: 'ნებისმიერი',
                    salary: '2000-3000 ₾',
                    description: '5 წლიანი გამოცდილება ინტერიერის დიზაინში...',
                    posted: '1 დღის წინ',
                    jobType: 'seeking',
                    tags: ['Corona Renderer', '3ds Max', 'კომერციული დიზაინი']
                },
                { 
                    title: 'კონსტრუქტორი',
                    company: 'დამოუკიდებელი ინჟინერი',
                    avatar: 'https://placehold.co/400x400?text=User3',
                    location: 'ბათუმი',
                    type: 'სრული განაკვეთი',
                    salary: '3000-4000 ₾',
                    description: '8 წლიანი გამოცდილება კონსტრუქციულ გაანგარიშებებში...',
                    posted: '3 დღის წინ',
                    jobType: 'seeking',
                    tags: ['SAFE', 'ETABS', 'Robot Structural', 'სეისმური ანალიზი']
                },
                { 
                    title: '3D მოდელირების სპეციალისტი',
                    company: 'ფრილანსერი',
                    avatar: 'https://placehold.co/400x400?text=User4',
                    location: 'დისტანციური',
                    type: 'ნებისმიერი',
                    salary: '2500-3500 ₾',
                    description: 'პროფესიონალი 3D მოდელირების სპეციალისტი ეძებს სამსახურს...',
                    posted: '4 დღის წინ',
                    jobType: 'seeking',
                    tags: ['Blender', 'Maya', 'ZBrush', 'რენდერინგი']
                },
                { 
                    title: 'პროექტის ხელმძღვანელი',
                    company: 'დამოუკიდებელი მენეჯერი',
                    avatar: 'https://placehold.co/400x400?text=User5',
                    location: 'თბილისი',
                    type: 'სრული განაკვეთი',
                    salary: '4000-5000 ₾',
                    description: '12 წლიანი გამოცდილება პროექტების მართვაში...',
                    posted: '5 დღის წინ',
                    jobType: 'seeking',
                    tags: ['Agile', 'Scrum', 'Jira', 'რისკების მართვა']
                }
            ],
            get filteredJobs() {
                return this.jobs.filter(job => {
                    const matchesFilter = job.jobType === this.activeFilter;
                    const matchesSearch = job.title.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                                        job.company.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                                        job.location.toLowerCase().includes(this.searchQuery.toLowerCase());
                    return matchesFilter && matchesSearch;
                });
            }
         }">
        
        <!-- Search and Filters Card -->
        <div class="bg-white dark:bg-gray-800/50 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700/50 backdrop-blur-sm p-6 mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">ვაკანსიები</h2>
                <button class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-xl font-medium transition-all duration-200 shadow-md hover:shadow-lg">
                    <i class="fas fa-plus"></i>
                    ვაკანსიის დამატება
                </button>
            </div>

            <!-- Search Bar -->
            <div class="relative mb-6">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input 
                    type="text" 
                    x-model="searchQuery"
                    placeholder="ძებნა სათაურით, კომპანიით ან ლოკაციით..."
                    class="w-full pl-11 pr-4 py-3.5 bg-gray-50 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 focus:border-transparent shadow-sm transition-all duration-200 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500"
                >
            </div>

            <!-- Job Type Filter -->
            <div class="flex flex-wrap gap-4 border-b border-gray-100 dark:border-gray-700/50">
                <button @click="activeFilter = 'hiring'"
                        :class="{ 'text-primary-600 dark:text-primary-400 border-primary-600 dark:border-primary-400': activeFilter === 'hiring' }"
                        class="px-4 py-3 text-sm font-medium text-gray-600 dark:text-gray-400 border-b-2 border-transparent hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200">
                    ვეძებთ თანამშრომელს
                    <span class="ml-2 px-2.5 py-1 text-xs rounded-full bg-gray-100 dark:bg-gray-700" x-text="jobs.filter(job => job.jobType === 'hiring').length"></span>
                </button>
                <button @click="activeFilter = 'seeking'"
                        :class="{ 'text-primary-600 dark:text-primary-400 border-primary-600 dark:border-primary-400': activeFilter === 'seeking' }"
                        class="px-4 py-3 text-sm font-medium text-gray-600 dark:text-gray-400 border-b-2 border-transparent hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200">
                    ვეძებ სამსახურს
                    <span class="ml-2 px-2.5 py-1 text-xs rounded-full bg-gray-100 dark:bg-gray-700" x-text="jobs.filter(job => job.jobType === 'seeking').length"></span>
                </button>
            </div>
        </div>

        <!-- Job Cards -->
        <div class="space-y-6">
            <template x-for="job in filteredJobs" :key="job.title">
                <div class="bg-white dark:bg-gray-800/50 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700/50 backdrop-blur-sm p-6 group hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex flex-col h-full">
                        <div class="flex items-center gap-4 mb-4">
                            <template x-if="job.jobType === 'hiring'">
                                <img :src="job.companyLogo" :alt="job.company" class="w-16 h-16 object-contain rounded-lg">
                            </template>
                            <template x-if="job.jobType === 'seeking'">
                                <img :src="job.avatar" :alt="job.company" class="w-16 h-16 object-cover rounded-full">
                            </template>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white" x-text="job.title"></h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400" x-text="job.company"></p>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-4 text-sm text-gray-600 dark:text-gray-400">
                            <span class="flex items-center gap-2">
                                <i class="fas fa-location-dot"></i>
                                <span x-text="job.location"></span>
                            </span>
                            <span class="flex items-center gap-2">
                                <i class="fas fa-clock"></i>
                                <span x-text="job.type"></span>
                            </span>
                            <span class="flex items-center gap-2">
                                <i class="fas fa-money-bill"></i>
                                <span x-text="job.salary"></span>
                            </span>
                        </div>
                        <p class="mt-4 text-sm text-gray-700 dark:text-gray-300 flex-grow" x-text="job.description"></p>
                        
                        <!-- Tags Section -->
                        <div class="flex flex-wrap gap-2 mt-4">
                            <template x-for="tag in job.tags" :key="tag">
                                <span class="px-3 py-1 text-xs font-medium bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 rounded-full">
                                    <span x-text="tag"></span>
                                </span>
                            </template>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mt-6 pt-6 border-t border-gray-100 dark:border-gray-700/50">
                            <span class="text-sm text-gray-500 dark:text-gray-400" x-text="job.posted"></span>
                            <button class="w-full sm:w-auto px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-xl transition-all duration-200 shadow-md hover:shadow-lg">
                                დეტალურად
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</x-layout>