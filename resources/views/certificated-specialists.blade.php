<x-layout>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">სერტიფიცირებული სპეციალისტები</h1>
            
            @if(auth()->user() && auth()->user()->is_admin)
                <a href="{{ route('admin.certificates.create') }}" wire:navigate class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    სერთიფიკატის შექმნა
                </a>
            @endif
        </div>
    </div>
    @foreach($certificates as $certificate)
        <div class="min-h-screen pb-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                    <div class="flex flex-col lg:flex-row">
                        <!-- Left Column - Profile Image and Basic Info -->
                        <div class="lg:w-1/3 bg-gradient-to-b from-indigo-700 to-indigo-900 dark:from-indigo-800 dark:to-indigo-950 p-8 text-white relative overflow-hidden">
                            <!-- Decorative circles -->
                            <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mt-32 -mr-32"></div>
                            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-5 rounded-full -mb-24 -ml-24"></div>
                            
                            <div class="relative">
                                <div class="mb-8 relative">
                                    <div class="absolute inset-0 border-4 border-indigo-200 dark:border-indigo-800 rounded-full transform rotate-45"></div>
                                    <img
                                        src={{ $certificate->user->profile_photo_path ? asset('storage/' . $certificate->user->image->path) : 'https://ui-avatars.com/api/?name=' . urlencode($certificate->user->name) . '&color=7F9CF5&background=EBF4FF' }}" alt="{{ $certificate->comments->last()->user->name }}"
                                        alt="Professional architect portrait"
                                        class="rounded-full w-48 h-48 object-cover mx-auto border-4 border-white shadow-lg transform transition-transform duration-300 hover:scale-105"
                                    />
                                </div>
                                <div class="space-y-4">
                                    <div class="text-center">
                                        <h2 class="text-2xl font-bold mb-1">{{$certificate->user->name}}</h2>
                                        <div class="flex items-center justify-center space-x-2 mb-4">
                                            <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                            </svg>
                                            <p class="text-gray-50">{{ $certificate->speciality->name }}</p>
                                        </div>
                                    </div>

                                    <div class="space-y-4 bg-black/10 rounded-xl p-4 backdrop-blur-sm">
                                        <div class="flex items-center space-x-3 transition-transform duration-200 hover:translate-x-1">
                                            <div class="p-2 bg-white/10 rounded-lg">
                                                <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                            <a href="mailto:{{$certificate->email}}" class="hover:text-gray-200">{{$certificate->email}}</a>
                                        </div>
                                        <div class="flex items-center space-x-3 transition-transform duration-200 hover:translate-x-1">
                                            <div class="p-2 bg-white/10 rounded-lg">
                                                <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                </svg>
                                            </div>
                                            <span>{{$certificate->phone_number}}</span>
                                        </div>
                                        <div class="flex items-center space-x-3 transition-transform duration-200 hover:translate-x-1">
                                            <div class="p-2 bg-white/10 rounded-lg">
                                                <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                            </div>
                                            <span>{{$certificate->location}}</span>
                                        </div>
                                    </div>

                                    <div class="pt-4">
                                        <div class="flex items-center space-x-2 mb-3">
                                            <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                            </svg>
                                            <span class="text-sm">{{$certificate->education_level}}</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="text-sm">{{$certificate->experience}}</span>
                                        </div>
                                    </div>

                                    <div class="pt-6 flex justify-center space-x-4">
                                        <a href="#" class="p-2 bg-white/10 rounded-lg hover:bg-white/20 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/>
                                            </svg>
                                        </a>
                                        <a href="#" class="p-2 bg-white/10 rounded-lg hover:bg-white/20 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/>
                                            </svg>
                                        </a>
                                        <a href="#" class="p-2 bg-white/10 rounded-lg hover:bg-white/20 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Certificate Details -->
                        <div class="lg:w-2/3 p-8">
                            <div class="border-2 border-gray-200 dark:border-gray-700 rounded-lg p-6 mb-6 relative overflow-hidden">
                                <div class="absolute top-0 right-0 w-32 h-32 -mt-8 -mr-8 bg-indigo-100 dark:bg-indigo-900 rounded-full opacity-20"></div>
                                <h1 class="text-xl font-bold text-gray-800 dark:text-white mb-4">პროფესიონალური არქიტექტურის სერტიფიკატი</h1>
                                <div class="grid grid-cols-2 gap-6 mb-6">
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">სერტიფიკატის №</p>
                                        <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $certificate->certificate_number }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">გაცემის თარიღი</p>
                                        <p class="font-semibold text-gray-900 dark:text-gray-100">{{ \Carbon\Carbon::parse($certificate->release_date)->format('d F, Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">ვადის გასვლის თარიღი</p>
                                        <p class="font-semibold text-gray-900 dark:text-gray-100">{{ \Carbon\Carbon::parse($certificate->release_date)->addYears($certificate->lifetime_years)->format('d F, Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">სტატუსი</p>
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <p class="font-semibold text-green-500">{{$certificate->status->label()}}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-4 mb-6">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                        </svg>
                                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">სპეციალიზაციები</h3>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="bg-indigo-50 dark:bg-indigo-900/20 p-4 rounded-xl border border-gray-200 dark:border-gray-700 transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                                            <div class="flex items-center space-x-3">
                                                <div class="p-2 rounded-lg text-indigo-600 dark:text-indigo-400 bg-white/10">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                                    </svg>
                                                </div>
                                                <p class="font-medium text-gray-800 dark:text-gray-200">{{$certificate->speciality->name}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-1 mb-2">
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">({{$certificate->stars}}/5 საშუალო შეფასება)</span>
                                </div>
                            </div>

                            <!-- Testimonials Section -->
                            <div class="relative">
                                <div class="bg-indigo-50/50 dark:bg-indigo-900/30 rounded-xl p-8 shadow-lg backdrop-blur-sm">
                                    <div class="flex justify-between items-center mb-6">
                                        <h3 class="text-xl font-bold text-gray-800 dark:text-white flex items-center">
                                            <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                            </svg>
                                            კლიენტების შეფასებები
                                        </h3>
                                    </div>

                                    <div id="testimonial-carousel" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <!-- Testimonial 1 -->

                                            <div class="carousel-item active">
                                                <div class="bg-white dark:bg-gray-800/90 rounded-xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 relative">
                                                    <div class="absolute -top-3 -left-3 w-12 h-12 bg-white dark:bg-gray-800 rounded-full flex items-center justify-center shadow-lg border-2 border-gray-100 dark:border-gray-700">
                                                        <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                                        </svg>
                                                    </div>
                                                    <div class="flex items-center space-x-4 mb-4 pt-2">
                                                        <img src="{{ $certificate->comments->last()->user->profile_photo_path ? asset('storage/' . $certificate->comments->last()->user->image->path) : 'https://ui-avatars.com/api/?name=' . urlencode($certificate->comments->last()->user->name) . '&color=7F9CF5&background=EBF4FF' }}" alt="{{ $certificate->comments->last()->user->name }}" class="w-12 h-12 rounded-full -mr-2">
                                                            <h4 class="font-semibold text-gray-800 dark:text-white">{{$certificate->comments->last()->user->name}}</h4>
                                                            <p class="text-sm text-gray-600 dark:text-gray-400">{{$certificate->comments->last()->user->position}}, {{$certificate->comments->last()->user->company}}</p>
                                                    </div>
                                                    <p class="text-gray-600 dark:text-gray-400">{{$certificate->comments->last()->content}}</p>
                                                    {{-- <div class="flex items-center space-x-1 justify-end">
                                                        <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                        </svg>
                                                        <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                        </svg>
                                                        <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                        </svg>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Action Buttons Section -->
                            <div class="mt-8 space-y-4">
                                <a href="{{ route('certificated-specialists.show', $certificate) }}" wire:navigate class="flex items-center justify-center w-full px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors duration-200 shadow-md">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    დეტალურად ნახვა
                                </a>
                                
                                @if(auth()->user() && auth()->user()->is_admin)
                                    <div class="grid grid-cols-2 gap-3">
                                        <a href="{{ route('admin.certificates.edit', $certificate) }}" wire:navigate class="flex items-center justify-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg transition-colors duration-200 shadow-md">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            რედაქტირება
                                        </a>
                                        
                                        <form action="{{ route('admin.certificates.destroy', $certificate) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="flex items-center justify-center w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors duration-200 shadow-md" onclick="return confirm('დარწმუნებული ხართ რომ გსურთ წაშლა?')">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                წაშლა
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-layout>