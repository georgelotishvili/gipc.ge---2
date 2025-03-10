<div x-show="showJobs"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform scale-95"
     x-transition:enter-end="opacity-100 transform scale-100"
     class="bg-white dark:bg-gray-800/50 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700/50 backdrop-blur-sm"
     x-data="{ 
        searchQuery: '',
        activeFilter: 'hiring',
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
    <!-- Header Section -->
    <div class="p-4 md:p-6 border-b border-gray-100 dark:border-gray-700/50">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white">ვაკანსიები</h2>
            <button @click="showJobs = false" 
                    class="p-2 text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                <i class="fas fa-times text-lg"></i>
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
                class="w-full pl-11 pr-4 py-3 bg-gray-50 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 focus:border-transparent shadow-sm transition-shadow text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500"
            >
        </div>

        <!-- Job Type Filter -->
        <div class="flex space-x-4 border-b border-gray-100 dark:border-gray-700/50">
            <button @click="activeFilter = 'hiring'"
                    :class="{ 'text-primary-600 dark:text-primary-400 border-primary-600 dark:border-primary-400': activeFilter === 'hiring' }"
                    class="px-4 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-400 border-b-2 border-transparent hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200">
                ვეძებთ თანამშრომელს
                <span class="ml-2 px-2 py-0.5 text-xs rounded-full bg-gray-100 dark:bg-gray-700" x-text="jobs.filter(job => job.jobType === 'hiring').length"></span>
            </button>
            <button @click="activeFilter = 'seeking'"
                    :class="{ 'text-primary-600 dark:text-primary-400 border-primary-600 dark:border-primary-400': activeFilter === 'seeking' }"
                    class="px-4 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-400 border-b-2 border-transparent hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200">
                ვეძებ სამსახურს
                <span class="ml-2 px-2 py-0.5 text-xs rounded-full bg-gray-100 dark:bg-gray-700" x-text="jobs.filter(job => job.jobType === 'seeking').length"></span>
            </button>
        </div>
    </div>

    <!-- Jobs List -->
    <div class="p-4 md:p-6 space-y-6">
        <template x-for="job in filteredJobs" :key="job.title">
            <div class="group relative bg-white dark:bg-gray-800/30 rounded-xl p-5 shadow-md hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700/50 hover:border-primary-500/50 dark:hover:border-primary-400/50">
                <div class="absolute inset-0 bg-gradient-to-br from-primary-50 dark:from-primary-500/5 to-transparent dark:to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl"></div>
                
                <div class="relative z-10">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <div class="flex items-center flex-wrap gap-3 mb-3">
                                <h3 x-text="job.title" class="text-lg font-semibold text-gray-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors"></h3>
                                <span class="px-3 py-1 text-xs font-medium rounded-full shadow-sm" 
                                      :class="{
                                          'bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-400': job.jobType === 'hiring',
                                          'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-400': job.jobType === 'seeking'
                                      }">
                                    <span x-text="job.jobType === 'hiring' ? 'ვეძებთ თანამშრომელს' : 'ვეძებ სამსახურს'"></span>
                                </span>
                            </div>
                            
                            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 dark:text-gray-400">
                                <span class="flex items-center bg-gray-50 dark:bg-gray-800/50 px-3 py-1 rounded-full shadow-sm">
                                    <i class="fas fa-building mr-2 text-primary-500 dark:text-primary-400"></i>
                                    <span x-text="job.company"></span>
                                </span>
                                <span class="flex items-center bg-gray-50 dark:bg-gray-800/50 px-3 py-1 rounded-full shadow-sm">
                                    <i class="fas fa-map-marker-alt mr-2 text-primary-500 dark:text-primary-400"></i>
                                    <span x-text="job.location"></span>
                                </span>
                                <span class="flex items-center bg-gray-50 dark:bg-gray-800/50 px-3 py-1 rounded-full shadow-sm">
                                    <i class="fas fa-clock mr-2 text-primary-500 dark:text-primary-400"></i>
                                    <span x-text="job.type"></span>
                                </span>
                                <span class="flex items-center bg-gray-50 dark:bg-gray-800/50 px-3 py-1 rounded-full shadow-sm">
                                    <i class="fas fa-money-bill-wave mr-2 text-primary-500 dark:text-primary-400"></i>
                                    <span x-text="job.salary"></span>
                                </span>
                            </div>
                        </div>
                        
                        <div class="flex flex-col items-end gap-2">
                            <span x-text="job.posted" class="text-sm text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-800/50 px-3 py-1 rounded-full shadow-sm"></span>
                            <span class="px-2 py-0.5 text-xs bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-400 rounded-full shadow-sm">
                                აქტიური
                            </span>
                        </div>
                    </div>

                    <p x-text="job.description" class="text-gray-700 dark:text-gray-300 mb-6 line-clamp-2 group-hover:line-clamp-none transition-all duration-300"></p>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-700/50">
                        <button class="inline-flex items-center px-5 py-2.5 bg-primary-600 hover:bg-primary-700 text-white rounded-lg text-sm font-medium transition-all duration-300 hover:shadow-lg hover:shadow-primary-600/20">
                            <i class="fas fa-paper-plane mr-2"></i>
                            განაცხადის გაგზავნა
                        </button>
                        <div class="flex gap-3">
                            <button class="p-2.5 text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 bg-gray-50 dark:bg-gray-800/50 rounded-lg hover:bg-primary-50 dark:hover:bg-primary-900/50 transition-colors shadow-sm">
                                <i class="fas fa-bookmark"></i>
                            </button>
                            <button class="p-2.5 text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 bg-gray-50 dark:bg-gray-800/50 rounded-lg hover:bg-primary-50 dark:hover:bg-primary-900/50 transition-colors shadow-sm">
                                <i class="fas fa-share-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <div class="mt-6 text-center">
            <button class="inline-flex items-center gap-2 px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-lg font-medium transition-colors">
                <i class="fas fa-plus"></i>
                ვაკანსიის დამატება
            </button>
        </div>
    </div>
</div> 