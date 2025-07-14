<x-layout>
    <!-- Flash Messages -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Close</title>
                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                </svg>
            </span>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Close</title>
                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                </svg>
            </span>
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Validation Error!</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Close</title>
                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                </svg>
            </span>
        </div>
    @endif

<!-- Main Content -->
    <div class="w-full px-4 sm:px-6 lg:px-8 py-12"
         x-data="{ 
            searchQuery: '',
            activeFilter: 'hiring',
         }">
        
        <!-- Search and Filters Card -->
        <div class="bg-white dark:bg-gray-800/50 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700/50 backdrop-blur-sm p-6 mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">ვაკანსიები</h2>
                <div class="flex gap-3">
                    <a href="{{ route('employees.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-xl font-medium transition-all duration-200 shadow-md hover:shadow-lg">
                        <i class="fas fa-plus"></i>
                        ვეძებ სამსახურს
                    </a>
                    <a href="{{ route('employers.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-xl font-medium transition-all duration-200 shadow-md hover:shadow-lg">
                        <i class="fas fa-plus"></i>
                        ვეძებ თანამშრომელს
                    </a>
                </div>
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
                    <span class="ml-2 px-2.5 py-1 text-xs rounded-full bg-gray-100 dark:bg-gray-700" x-text="{{$employers->count()}}"></span>
                </button>
                <button @click="activeFilter = 'seeking'"
                        :class="{ 'text-primary-600 dark:text-primary-400 border-primary-600 dark:border-primary-400': activeFilter === 'seeking' }"
                        class="px-4 py-3 text-sm font-medium text-gray-600 dark:text-gray-400 border-b-2 border-transparent hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200">
                        ვეძებ სამსახურს
                    <span class="ml-2 px-2.5 py-1 text-xs rounded-full bg-gray-100 dark:bg-gray-700" x-text="{{$employees->count()}}"></span>
                </button>
            </div>
        </div>

        <!-- Job Cards -->
        <div class="space-y-6">
            <!-- Employers (Hiring) Section -->
            <div x-show="activeFilter === 'hiring'" x-cloak x-transition>
                @foreach($employers as $employer)
                <div class="bg-white dark:bg-gray-800/50 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700/50 backdrop-blur-sm p-6 group hover:shadow-xl transition-all duration-300 hover:-translate-y-1"
                     x-show="searchQuery === '' || 
                            '{{ strtolower($employer->name) }}'.includes(searchQuery.toLowerCase()) || 
                            '{{ strtolower($employer->position) }}'.includes(searchQuery.toLowerCase()) || 
                            '{{ strtolower($employer->description) }}'.includes(searchQuery.toLowerCase()) || 
                            '{{ strtolower($employer->skills) }}'.includes(searchQuery.toLowerCase()) || 
                            '{{ $employer->salary }}'.includes(searchQuery)">
                    <div class="flex flex-col h-full">
                        <div class="flex items-center gap-4 mb-4">
                            @if($employer->image)
                                <img src="{{ asset('storage/' . $employer->image->path) }}" alt="{{ $employer->name }}" class="w-16 h-16 object-contain rounded-lg">
                            @else
                                <div class="w-16 h-16 bg-blue-500 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-building text-white text-2xl"></i>
                                </div>
                            @endif
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $employer->position }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $employer->name }}</p>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-4 text-sm text-gray-600 dark:text-gray-400">
                            <span class="flex items-center gap-2">
                                <i class="fas fa-location-dot"></i>
                                <span>{{ $employer->city }}</span>
                            </span>
                            <span class="flex items-center gap-2">
                                <i class="fas fa-clock"></i>
                                <span>{{ $employer->worktime->label() }}</span>
                            </span>
                            <span class="flex items-center gap-2">
                                <i class="fas fa-money-bill"></i>
                                <span>{{ $employer->salary }} ₾</span>
                            </span>
                        </div>
                        <p class="mt-4 text-sm text-gray-700 dark:text-gray-300 flex-grow">{{ Str::limit($employer->description, 150) }}</p>
                        
                        <!-- Tags Section -->
                        <div class="flex flex-wrap gap-2 mt-4">
                            @foreach(explode(',', $employer->skills) as $skill)
                                <span class="px-3 py-1 text-xs font-medium bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 rounded-full">
                                    {{ trim($skill) }}
                                </span>
                            @endforeach
                        </div>

                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mt-6 pt-6 border-t border-gray-100 dark:border-gray-700/50">
                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $employer->created_at->diffForHumans() }}</span>
                            <div class="flex flex-col sm:flex-row gap-2">
                                @if(Auth::check() && (Auth::user()->id == $employer->user_id || Auth::user()->is_admin))
                                    <a href="{{ route('employers.edit', $employer) }}" class="w-full sm:w-auto px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-xl transition-all duration-200 shadow-md hover:shadow-lg text-center">
                                        <i class="fas fa-edit mr-1"></i> რედაქტირება
                                    </a>
                                    <form action="{{ route('employers.destroy', $employer) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('დარწმუნებული ხართ?')" class="w-full sm:w-auto px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-xl transition-all duration-200 shadow-md hover:shadow-lg">
                                            <i class="fas fa-trash-alt mr-1"></i> წაშლა
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ route('employers.show', $employer) }}" class="w-full sm:w-auto px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-xl transition-all duration-200 shadow-md hover:shadow-lg text-center">
                                    დეტალურად
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Employees (Seeking Jobs) Section -->
            <div x-show="activeFilter === 'seeking'" x-cloak x-transition>
                @foreach($employees as $employee)
                <div class="relative group"
                     x-show="searchQuery === '' || 
                            '{{ strtolower($employee->name) }}'.includes(searchQuery.toLowerCase()) || 
                            '{{ strtolower($employee->position) }}'.includes(searchQuery.toLowerCase()) || 
                            '{{ strtolower($employee->description) }}'.includes(searchQuery.toLowerCase()) || 
                            '{{ strtolower($employee->skills) }}'.includes(searchQuery.toLowerCase()) || 
                            '{{ $employee->salary }}'.includes(searchQuery)">
                    
                    <!-- Subtle Background -->
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-indigo-500/5 rounded-3xl blur-lg group-hover:blur-xl transition-all duration-500"></div>
                    
                    <!-- Main Card - Entirely Clickable -->
                    <a href="{{ route('employees.show', $employee) }}" class="block relative bg-white dark:bg-gray-900/95 backdrop-blur-xl rounded-3xl p-6 group-hover:scale-[1.005] transition-all duration-300 shadow-lg dark:shadow-none hover:shadow-2xl dark:hover:shadow-none hover:shadow-gray-300/50 dark:hover:shadow-gray-800/50 overflow-hidden border border-gray-100 dark:border-gray-700/50 cursor-pointer">
                        
                        <!-- Header Section -->
                        <div class="relative mb-4">
                            <!-- Status Badge -->
                            <div class="absolute top-0 right-0 bg-green-500 text-white px-3 py-1.5 rounded-full text-xs font-semibold shadow-md z-10">
                                <i class="fas fa-circle text-xs mr-1"></i>Available
                            </div>
                            
                            <div class="flex items-start gap-4">
                                <!-- Profile Image -->
                                <div class="relative flex-shrink-0">
                                    @if($employee->image)
                                        <div class="relative">
                                            <div class="absolute inset-0 bg-blue-500 rounded-2xl blur-md opacity-20 group-hover:opacity-30 transition-all duration-300"></div>
                                            <img src="{{ asset('storage/' . optional($employee->image()->latest()->first())->path) }}" 
                                                 alt="{{ $employee->name }}" 
                                                 class="relative w-16 h-16 object-cover rounded-2xl border-2 border-gray-200 dark:border-gray-700 shadow-lg">
                                        </div>
                                    @else
                                        <div class="relative">
                                            <div class="absolute inset-0 bg-blue-500 rounded-2xl blur-md opacity-20 group-hover:opacity-30 transition-all duration-300"></div>
                                            <div class="relative w-16 h-16 bg-blue-500 rounded-2xl flex items-center justify-center border-2 border-gray-200 dark:border-gray-700 shadow-lg">
                                                <i class="fas fa-user text-white text-xl"></i>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <!-- Online Status -->
                                    <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 border-2 border-white dark:border-gray-900 rounded-full shadow-md"></div>
                                </div>
                                
                                <!-- Name and Position -->
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-1 leading-tight">
                                        {{ $employee->position }}
                                    </h3>
                                    <p class="text-lg text-gray-700 dark:text-gray-300 font-medium mb-2">{{ $employee->name }}</p>
                                    
                                    <!-- Info Tags -->
                                    <div class="flex flex-wrap gap-2">
                                        <span class="inline-flex items-center px-3 py-1.5 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-sm font-medium rounded-lg border border-blue-200 dark:border-blue-700/50 shadow-sm">
                                            <i class="fas fa-map-marker-alt mr-1.5 text-xs"></i>{{ $employee->city }}
                                        </span>
                                        <span class="inline-flex items-center px-3 py-1.5 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 text-sm font-medium rounded-lg border border-indigo-200 dark:border-indigo-700/50 shadow-sm">
                                            <i class="fas fa-clock mr-1.5 text-xs"></i>{{ $employee->worktime->label() }}
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Salary Badge -->
                                <div class="flex-shrink-0">
                                    <div class="bg-green-500 text-white px-4 py-3 rounded-xl shadow-lg text-center">
                                        <div class="text-sm font-medium opacity-90">Salary</div>
                                        <div class="text-lg font-bold">{{ $employee->salary }} ₾</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Skills Section - Show All -->
                        <div class="mb-4">
                            <h4 class="text-sm font-semibold text-gray-600 dark:text-gray-400 mb-3 uppercase tracking-wider flex items-center">
                                <i class="fas fa-tools mr-2 text-blue-500"></i>უნარები & გამოცდილება
                            </h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach(explode(',', $employee->skills) as $skill)
                                    <span class="inline-flex items-center px-3 py-1.5 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-sm font-medium rounded-lg border border-blue-200 dark:border-blue-700/50 shadow-sm hover:bg-blue-100 dark:hover:bg-blue-900/50 transition-colors duration-200">
                                        <i class="fas fa-check-circle mr-1.5 text-green-500 text-xs"></i>{{ trim($skill) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Footer - Compact -->
                        <div class="flex items-center justify-between pt-3 border-t border-gray-200 dark:border-gray-700/50">
                            <!-- Time Info -->
                            <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                <span>Posted {{ $employee->created_at->diffForHumans() }}</span>
                            </div>
                            
                            <!-- Action Buttons - Only for owners/admins -->
                            <div class="flex gap-2">
                                @if(Auth::check() && (Auth::user()->id == $employee->user_id || Auth::user()->is_admin))
                                    <a href="{{ route('employees.edit', $employee) }}" 
                                       class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-200"
                                       onclick="event.stopPropagation()">
                                        <i class="fas fa-edit mr-1.5"></i> Edit
                                    </a>
                                    
                                    <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="inline" onclick="event.stopPropagation()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('დარწმუნებული ხართ?')" 
                                                class="inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                                            <i class="fas fa-trash-alt mr-1.5"></i> Delete
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layout>