<x-layout>
    <style>
        .job-card {
            background: white;
            border-radius: 0.375rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            border: 1px solid #f3f4f6;
            transition: all 0.2s ease-in-out;
        }
        
        .dark .job-card {
            background: #1f2937;
            border-color: #374151;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.3), 0 1px 2px 0 rgba(0, 0, 0, 0.2);
        }
        
        .job-card:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transform: translateY(-1px);
        }
        
        .dark .job-card:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.4), 0 2px 4px -1px rgba(0, 0, 0, 0.3);
        }
        
        .search-input {
            background: white;
            border: 1px solid #d1d5db;
            color: #374151;
            transition: all 0.2s ease-in-out;
        }
        
        .dark .search-input {
            background: #374151;
            border-color: #4b5563;
            color: #f9fafb;
        }
        
        .search-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            outline: none;
        }
        
        .dark .search-input:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }
        
        .search-input::placeholder {
            color: #9ca3af;
        }
        
        .dark .search-input::placeholder {
            color: #6b7280;
        }
        
        .filter-button {
            transition: all 0.2s ease-in-out;
        }
        
        .filter-button.active {
            background-color: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }
        
        .filter-button:not(.active) {
            background-color: #f9fafb;
            color: #6b7280;
            border-color: #d1d5db;
        }
        
        .dark .filter-button:not(.active) {
            background-color: #374151;
            color: #9ca3af;
            border-color: #4b5563;
        }
        
        .filter-button:hover:not(.active) {
            background-color: #f3f4f6;
            border-color: #9ca3af;
        }
        
        .dark .filter-button:hover:not(.active) {
            background-color: #4b5563;
            border-color: #6b7280;
        }
        
        .primary-button {
            background-color: #3b82f6;
            color: white;
            transition: all 0.2s ease-in-out;
        }
        
        .primary-button:hover {
            background-color: #2563eb;
            transform: translateY(-1px);
        }
        
        .secondary-button {
            background-color: white;
            color: #374151;
            border: 1px solid #d1d5db;
            transition: all 0.2s ease-in-out;
        }
        
        .dark .secondary-button {
            background-color: #374151;
            color: #f9fafb;
            border-color: #4b5563;
        }
        
        .secondary-button:hover {
            background-color: #f9fafb;
            border-color: #9ca3af;
        }
        
        .dark .secondary-button:hover {
            background-color: #4b5563;
            border-color: #6b7280;
        }
        
        .skill-tag {
            background-color: #f3f4f6;
            color: #374151;
            transition: all 0.2s ease-in-out;
        }
        
        .dark .skill-tag {
            background-color: #374151;
            color: #f9fafb;
        }
        
        .skill-tag:hover {
            background-color: #e5e7eb;
            transform: scale(1.05);
        }
        
        .dark .skill-tag:hover {
            background-color: #4b5563;
        }
        
        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 0.375rem;
            background-color: #10b981;
        }
    </style>
    
    <!-- Flash Messages -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md relative mb-4" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md relative mb-4" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md relative mb-4" role="alert">
            <strong class="font-bold">Validation Error!</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Main Content -->
    <div class="min-h-screen dark:bg-gray-900 transition-colors duration-200">
        <div class="w-full px-3 sm:px-4 lg:px-6 xl:px-8 py-6 sm:py-8 lg:py-12"
             x-data="{ 
                searchQuery: '',
                activeFilter: 'hiring'
             }">
             
             <!-- Header -->
             <div class="text-center mb-8 sm:mb-12">
                 <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-3 sm:mb-4 text-gray-900 dark:text-white">
                     სამუშაო განცხადებები
                 </h1>
                 <p class="text-sm sm:text-base lg:text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto px-4">
                     იპოვე შენი შემდეგი შესაძლებლობა ან აღმოაჩინე ნიჭიერი პროფესიონალები
                 </p>
             </div>
             
             <!-- Search and Filters -->
             <div class="max-w-6xl mx-auto mb-8 sm:mb-12">
                 <div class="bg-white dark:bg-gray-800 rounded-md shadow-sm border border-gray-100 dark:border-gray-700 p-4 sm:p-6 lg:p-8 mb-6 sm:mb-8 transition-colors duration-200">
                     <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 sm:gap-6 mb-6 sm:mb-8">
                         <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 lg:gap-4">
                             <a href="{{ route('employees.create') }}" class="group relative inline-flex items-center justify-center gap-1.5 sm:gap-2 lg:gap-3 px-4 sm:px-6 lg:px-8 py-2.5 sm:py-3 lg:py-4 text-white bg-gradient-to-r from-blue-600 to-purple-600 rounded-md sm:rounded-md font-bold text-sm sm:text-base lg:text-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 overflow-hidden">
                                 <span class="relative z-10 flex items-center gap-1.5 sm:gap-2 lg:gap-3">
                                     <i class="fas fa-user-plus text-sm sm:text-lg lg:text-xl"></i>
                                     <span>შემოუერთდი</span>
                                 </span>
                                 <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                             </a>
                             <a href="{{ route('employers.create') }}" class="group relative inline-flex items-center justify-center gap-1.5 sm:gap-2 lg:gap-3 px-4 sm:px-6 lg:px-8 py-2.5 sm:py-3 lg:py-4 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 rounded-md sm:rounded-md font-bold text-sm sm:text-base lg:text-lg shadow-lg hover:shadow-xl hover:border-blue-500 dark:hover:border-blue-400 transform hover:scale-105 transition-all duration-300">
                                 <i class="fas fa-building text-sm sm:text-lg lg:text-xl"></i>
                                 <span>იპოვე თანამშრომელი</span>
                             </a>
                         </div>
                     </div>

                     <!-- Search Bar -->
                     <div class="relative mb-4 sm:mb-6 lg:mb-8">
                         <div class="absolute inset-y-0 left-0 pl-3 sm:pl-4 lg:pl-5 flex items-center pointer-events-none">
                             <i class="fas fa-search text-gray-400 dark:text-gray-500 text-sm sm:text-base lg:text-lg"></i>
                         </div>
                         <input 
                             type="text" 
                             x-model="searchQuery"
                             placeholder="ძებნა სამუშაოები, კომპანიები ან უნარები..."
                             class="w-full pl-10 sm:pl-12 lg:pl-14 pr-3 sm:pr-4 lg:pr-6 py-2.5 sm:py-3 lg:py-4 text-sm sm:text-base lg:text-lg bg-white dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 rounded-md sm:rounded-md shadow-sm focus:border-blue-500 focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-900 focus:outline-none transition-all duration-300 placeholder-gray-400 dark:placeholder-gray-500"
                         >
                     </div>

                     <!-- Job Type Filter -->
                     <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 lg:gap-4">
                         <button @click="activeFilter = 'hiring'"
                                 :class="activeFilter === 'hiring' ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg transform scale-105' : 'bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600'"
                                 class="group flex items-center justify-center gap-1.5 sm:gap-2 lg:gap-3 px-3 sm:px-4 lg:px-8 py-2.5 sm:py-3 lg:py-4 rounded-md sm:rounded-md border-2 border-gray-200 dark:border-gray-600 font-semibold transition-all duration-300 hover:shadow-md">
                             <i class="fas fa-briefcase text-xs sm:text-sm lg:text-lg"></i>
                             <span class="text-xs sm:text-sm lg:text-base">კომპანიები იქირავებენ</span>
                             <span class="px-1.5 sm:px-2 lg:px-3 py-0.5 sm:py-1 text-xs sm:text-sm rounded-md bg-white/20 text-white font-bold" x-text="{{$employers->count()}}"></span>
                         </button>
                         <button @click="activeFilter = 'seeking'"
                                 :class="activeFilter === 'seeking' ? 'bg-gradient-to-r from-emerald-500 to-emerald-600 text-white shadow-lg transform scale-105' : 'bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600'"
                                 class="group flex items-center justify-center gap-1.5 sm:gap-2 lg:gap-3 px-3 sm:px-4 lg:px-8 py-2.5 sm:py-3 lg:py-4 rounded-md sm:rounded-md border-2 border-gray-200 dark:border-gray-600 font-semibold transition-all duration-300 hover:shadow-md">
                             <i class="fas fa-users text-xs sm:text-sm lg:text-lg"></i>
                             <span class="text-xs sm:text-sm lg:text-base">სამუშაოს მაძიებლები</span>
                             <span class="px-1.5 sm:px-2 lg:px-3 py-0.5 sm:py-1 text-xs sm:text-sm rounded-md bg-white/20 text-white font-bold" x-text="{{$employees->count()}}"></span>
                         </button>
                     </div>
                 </div>
             </div>

             <!-- Job Cards -->
             <div class="max-w-6xl mx-auto px-4 sm:px-0">
                 <!-- Employers (Hiring) Section -->
                 <div x-show="activeFilter === 'hiring'" x-cloak x-transition>
                     <div class="space-y-4">
                         @foreach($employers as $employer)
                         <div class="job-card p-4 sm:p-5"
                              x-show="searchQuery === '' || 
                                     '{{ strtolower($employer->name) }}'.includes(searchQuery.toLowerCase()) || 
                                     '{{ strtolower($employer->position) }}'.includes(searchQuery.toLowerCase()) || 
                                     '{{ strtolower($employer->description) }}'.includes(searchQuery.toLowerCase()) || 
                                     '{{ strtolower($employer->skills) }}'.includes(searchQuery.toLowerCase()) || 
                                     '{{ $employer->salary }}'.includes(searchQuery)">
                             
                             <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                 <!-- Left side -->
                                 <div class="flex items-start sm:items-center space-x-3 sm:space-x-4">
                                     <!-- Company Logo -->
                                     <div class="w-12 h-12 sm:w-16 sm:h-16 bg-gray-100 dark:bg-gray-700 rounded-md flex items-center justify-center flex-shrink-0 shadow-sm border border-gray-200 dark:border-gray-600">
                                         @if($employer->image)
                                             <img src="{{ asset('storage/' . $employer->image->path) }}" alt="{{ $employer->name }}" class="w-10 h-10 sm:w-14 sm:h-14 rounded-md object-cover">
                                         @else
                                             <!-- Real company logos as fallbacks based on company name -->
                                             @php
                                                 $companyName = strtolower($employer->name);
                                                 $logoClass = 'w-6 h-6 sm:w-8 sm:h-8';
                                             @endphp
                                             @if(str_contains($companyName, 'google') || str_contains($companyName, 'გუგლი'))
                                                 <svg class="{{ $logoClass }} text-blue-500" viewBox="0 0 24 24" fill="currentColor">
                                                     <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                                     <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                                     <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                                     <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                                                 </svg>
                                             @elseif(str_contains($companyName, 'microsoft') || str_contains($companyName, 'მაიკროსოფტი'))
                                                 <svg class="{{ $logoClass }} text-blue-600" viewBox="0 0 24 24" fill="currentColor">
                                                     <path d="M0 0h11.377v11.372H0V0zm12.623 0H24v11.372H12.623V0zM0 12.628h11.377V24H0V12.628zm12.623 0H24V24H12.623V12.628z"/>
                                                 </svg>
                                             @elseif(str_contains($companyName, 'apple') || str_contains($companyName, 'ეპლი'))
                                                 <svg class="{{ $logoClass }} text-gray-800 dark:text-white" viewBox="0 0 24 24" fill="currentColor">
                                                     <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                                                 </svg>
                                             @elseif(str_contains($companyName, 'amazon') || str_contains($companyName, 'ამაზონი'))
                                                 <svg class="{{ $logoClass }} text-orange-500" viewBox="0 0 24 24" fill="currentColor">
                                                     <path d="M6.763 12.5c0-1.1.9-2 2-2s2 .9 2 2-.9 2-2 2-2-.9-2-2zm2-3c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3zm0-1c2.21 0 4 1.79 4 4s-1.79 4-4 4-4-1.79-4-4 1.79-4 4-4z"/>
                                                     <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                                                 </svg>
                                             @elseif(str_contains($companyName, 'facebook') || str_contains($companyName, 'ფეისბუქი'))
                                                 <svg class="{{ $logoClass }} text-blue-600" viewBox="0 0 24 24" fill="currentColor">
                                                     <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                                 </svg>
                                             @elseif(str_contains($companyName, 'tesla') || str_contains($companyName, 'ტესლა'))
                                                 <svg class="{{ $logoClass }} text-red-500" viewBox="0 0 24 24" fill="currentColor">
                                                     <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                                                 </svg>
                                             @else
                                                 <svg xmlns="http://www.w3.org/2000/svg" class="{{ $logoClass }} text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                 </svg>
                                             @endif
                                         @endif
                                     </div>

                                     <!-- Info -->
                                     <div class="min-w-0 flex-1">
                                         <h2 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white truncate">{{ $employer->position }}</h2>
                                         <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 truncate">{{ $employer->name }} • {{ $employer->city }}</p>
                                         <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-4 mt-1">
                                             <span class="text-xs text-gray-400 dark:text-gray-500">{{ $employer->worktime->label() }}</span>
                                             <span class="text-xs text-gray-400 dark:text-gray-500">{{ $employer->created_at->diffForHumans() }}</span>
                                         </div>
                                     </div>
                                 </div>

                                 <!-- Price -->
                                 <div class="text-left sm:text-right mt-2 sm:mt-0">
                                     <p class="text-base sm:text-lg font-semibold text-emerald-600">{{ $employer->salary }} ₾</p>
                                     <span class="text-xs text-gray-400 dark:text-gray-500">თვეში</span>
                                 </div>
                             </div>

                             <!-- Skills -->
                             <div class="mt-3 sm:mt-4 flex flex-wrap gap-1.5 sm:gap-2">
                                 @foreach(array_slice(explode(',', $employer->skills), 0, 4) as $skill)
                                     <span class="skill-tag px-2 sm:px-3 py-1 text-xs sm:text-sm rounded-md">{{ trim($skill) }}</span>
                                 @endforeach
                                 @if(count(explode(',', $employer->skills)) > 4)
                                     <span class="px-2 sm:px-3 py-1 text-xs sm:text-sm rounded-md bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400">
                                         +{{ count(explode(',', $employer->skills)) - 4 }} სხვა
                                     </span>
                                 @endif
                             </div>

                             <!-- Actions -->
                             <div class="mt-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 sm:gap-4">
                                 <div class="flex items-center space-x-4">
                                     <div class="flex items-center gap-2">
                                         <div class="status-dot"></div>
                                         <span class="text-xs sm:text-sm text-emerald-600 font-medium">აქტიური</span>
                                     </div>
                                 </div>
                                 
                                 <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 sm:gap-3">
                                     <a href="{{ route('employers.show', $employer) }}" class="group relative inline-flex items-center justify-center px-4 sm:px-6 py-2.5 sm:py-3 text-xs sm:text-sm font-bold text-white bg-gradient-to-r from-blue-600 to-purple-600 rounded-md shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 overflow-hidden">
                                         <span class="relative z-10 flex items-center gap-1.5 sm:gap-2">
                                             <i class="fas fa-rocket text-xs sm:text-sm"></i>
                                             <span>გაიგე მეტი</span>
                                         </span>
                                         <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                     </a>
                                     
                                     @if(Auth::check() && (Auth::user()->id == $employer->user_id || Auth::user()->is_admin))
                                     <div class="flex gap-2">
                                         <a href="{{ route('employers.edit', $employer) }}" class="flex-1 md:flex-none inline-flex items-center justify-center px-3 md:px-5 py-2 md:py-2.5 text-xs md:text-sm font-semibold text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-600 border border-gray-300 dark:border-gray-500 rounded-md hover:bg-gray-200 dark:hover:bg-gray-500 hover:border-gray-400 dark:hover:border-gray-400 transition-all duration-200" title="რედაქტირება">
                                             <i class="fas fa-edit"></i>
                                             <span class="hidden md:inline ml-1.5 md:ml-2">რედაქტირება</span>
                                         </a>
                                         <form action="{{ route('employers.destroy', $employer) }}" method="POST" class="flex-1 md:flex-none">
                                             @csrf
                                             @method('DELETE')
                                             <button type="submit" onclick="return confirm('დარწმუნებული ხართ?')" class="w-full inline-flex items-center justify-center px-3 md:px-5 py-2 md:py-2.5 text-xs md:text-sm font-semibold text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900 border border-red-200 dark:border-red-700 rounded-md hover:bg-red-100 dark:hover:bg-red-800 hover:border-red-300 dark:hover:border-red-600 transition-all duration-200" title="წაშლა">
                                                 <i class="fas fa-trash-alt"></i>
                                                 <span class="hidden md:inline ml-1.5 md:ml-2">წაშლა</span>
                                             </button>
                                         </form>
                                     </div>
                                     @endif
                                 </div>
                             </div>
                         </div>
                         @endforeach
                     </div>
                 </div>

                 <!-- Employees (Seeking Jobs) Section -->
                 <div x-show="activeFilter === 'seeking'" x-cloak x-transition>
                     <div class="space-y-4">
                         @foreach($employees as $employee)
                         <div class="job-card p-4 sm:p-5"
                              x-show="searchQuery === '' || 
                                     '{{ strtolower($employee->name) }}'.includes(searchQuery.toLowerCase()) || 
                                     '{{ strtolower($employee->position) }}'.includes(searchQuery.toLowerCase()) || 
                                     '{{ strtolower($employee->description) }}'.includes(searchQuery.toLowerCase()) || 
                                     '{{ strtolower($employee->skills) }}'.includes(searchQuery.toLowerCase()) || 
                                     '{{ $employee->salary }}'.includes(searchQuery)">
                             
                             <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                 <!-- Left side -->
                                 <div class="flex items-start sm:items-center space-x-3 sm:space-x-4">
                                     <!-- Profile Picture -->
                                     <div class="w-12 h-12 sm:w-16 sm:h-16 bg-gray-100 dark:bg-gray-700 rounded-md flex items-center justify-center flex-shrink-0 shadow-sm border border-gray-200 dark:border-gray-600">
                                         @if($employee->image)
                                             <img src="{{ asset('storage/' . optional($employee->image()->latest()->first())->path) }}" 
                                                  alt="{{ $employee->name }}" 
                                                  class="w-10 h-10 sm:w-14 sm:h-14 rounded-md object-cover">
                                         @else
                                             <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 sm:w-8 sm:h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                             </svg>
                                         @endif
                                     </div>

                                     <!-- Info -->
                                     <div class="min-w-0 flex-1">
                                         <h2 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white truncate">{{ $employee->position }}</h2>
                                         <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 truncate">{{ $employee->name }} • {{ $employee->city }}</p>
                                         <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-4 mt-1">
                                             <span class="text-xs text-gray-400 dark:text-gray-500">{{ $employee->worktime->label() }}</span>
                                             <span class="text-xs text-gray-400 dark:text-gray-500">{{ $employee->created_at->diffForHumans() }}</span>
                                         </div>
                                     </div>
                                 </div>

                                 <!-- Price -->
                                 <div class="text-left sm:text-right mt-2 sm:mt-0">
                                     <p class="text-base sm:text-lg font-semibold text-emerald-600">{{ $employee->salary }} ₾</p>
                                     <span class="text-xs text-gray-400 dark:text-gray-500">მოსალოდნელი</span>
                                 </div>
                             </div>

                             <!-- Skills -->
                             <div class="mt-3 sm:mt-4 flex flex-wrap gap-1.5 sm:gap-2">
                                 @foreach(array_slice(explode(',', $employee->skills), 0, 4) as $skill)
                                     <span class="skill-tag px-2 sm:px-3 py-1 text-xs sm:text-sm rounded-md">{{ trim($skill) }}</span>
                                 @endforeach
                                 @if(count(explode(',', $employee->skills)) > 4)
                                     <span class="px-2 sm:px-3 py-1 text-xs sm:text-sm rounded-md bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400">
                                         +{{ count(explode(',', $employee->skills)) - 4 }} სხვა
                                     </span>
                                 @endif
                             </div>

                             <!-- Actions -->
                             <div class="mt-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 sm:gap-4">
                                 <div class="flex items-center space-x-4">
                                     <div class="flex items-center gap-2">
                                         <div class="status-dot"></div>
                                         <span class="text-xs sm:text-sm text-emerald-600 font-medium">ხელმისაწვდომი</span>
                                     </div>
                                 </div>
                                 
                                 <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 sm:gap-3">
                                     <a href="{{ route('employees.show', $employee) }}" class="group relative inline-flex items-center justify-center px-4 sm:px-6 py-2.5 sm:py-3 text-xs sm:text-sm font-bold text-white bg-gradient-to-r from-emerald-500 to-teal-600 rounded-md shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 overflow-hidden">
                                         <span class="relative z-10 flex items-center gap-1.5 sm:gap-2">
                                             <i class="fas fa-user-astronaut text-xs sm:text-sm"></i>
                                             <span>გაიგე მეტი</span>
                                         </span>
                                         <div class="absolute inset-0 bg-gradient-to-r from-teal-600 to-emerald-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                     </a>
                                     
                                     @if(Auth::check() && (Auth::user()->id == $employee->user_id || Auth::user()->is_admin))
                                     <div class="flex gap-2">
                                         <a href="{{ route('employees.edit', $employee) }}" 
                                            class="flex-1 md:flex-none inline-flex items-center justify-center px-3 md:px-5 py-2 md:py-2.5 text-xs md:text-sm font-semibold text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-600 border border-gray-300 dark:border-gray-500 rounded-md hover:bg-gray-200 dark:hover:bg-gray-500 hover:border-gray-400 dark:hover:border-gray-400 transition-all duration-200"
                                            onclick="event.stopPropagation()" title="რედაქტირება">
                                             <i class="fas fa-edit"></i>
                                             <span class="hidden md:inline ml-1.5 md:ml-2">რედაქტირება</span>
                                         </a>
                                         <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="flex-1 md:flex-none" onclick="event.stopPropagation()">
                                             @csrf
                                             @method('DELETE')
                                             <button type="submit" onclick="return confirm('დარწმუნებული ხართ?')" 
                                                     class="w-full inline-flex items-center justify-center px-3 md:px-5 py-2 md:py-2.5 text-xs md:text-sm font-semibold text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900 border border-red-200 dark:border-red-700 rounded-md hover:bg-red-100 dark:hover:bg-red-800 hover:border-red-300 dark:hover:border-red-600 transition-all duration-200" title="წაშლა">
                                                 <i class="fas fa-trash-alt"></i>
                                                 <span class="hidden md:inline ml-1.5 md:ml-2">წაშლა</span>
                                             </button>
                                         </form>
                                     </div>
                                     @endif
                                 </div>
                             </div>
                         </div>
                         @endforeach
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </x-layout>
