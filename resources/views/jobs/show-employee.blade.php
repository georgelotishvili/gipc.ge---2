<x-layout>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
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

        <!-- Job Details Card -->
        <div class="bg-white dark:bg-gray-800/50 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700/50 backdrop-blur-sm overflow-hidden">
            <!-- Name and Position -->
            <div class="p-6 border-b border-gray-100 dark:border-gray-700/50">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $employee->position }}</h1>
                <p class="text-lg text-gray-600 dark:text-gray-400">{{ $employee->name }}</p>
            </div>

            <!-- Profile Image -->
            <div class="p-6">
                <div class="bg-white dark:bg-gray-800 rounded-xl p-2 shadow-lg border border-gray-100 dark:border-gray-700 inline-block">
                    @if($employee->image)
                        <img src="{{ asset('storage/' . $employee->image->path) }}" alt="{{ $employee->name }}" class="w-24 h-24 object-cover rounded-lg">
                    @else
                        <div class="w-24 h-24 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                            <i class="fas fa-user text-gray-400 dark:text-gray-500 text-4xl"></i>
                        </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                @if(Auth::check() && (Auth::user()->id == $employee->user_id || Auth::user()->is_admin))
                <div class="flex gap-2 mt-4">
                    <a href="{{ route('employees.edit', $employee) }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-xl transition-all duration-200 shadow-md hover:shadow-lg">
                        <i class="fas fa-edit mr-1"></i> რედაქტირება
                    </a>
                    <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('დარწმუნებული ხართ?')" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-xl transition-all duration-200 shadow-md hover:shadow-lg">
                            <i class="fas fa-trash-alt mr-1"></i> წაშლა
                        </button>
                    </form>
                </div>
                @endif
            </div>

            <!-- Resume Details -->
            <div class="p-6">
                <!-- Resume Highlights -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-xl">
                        <div class="flex items-center gap-3">
                            <div class="p-3 bg-primary-100 dark:bg-primary-900 text-primary-600 dark:text-primary-300 rounded-lg">
                                <i class="fas fa-location-dot text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">ლოკაცია</p>
                                <p class="font-medium text-gray-900 dark:text-gray-100">{{ $employee->city ?? 'არ არის მითითებული' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-xl">
                        <div class="flex items-center gap-3">
                            <div class="p-3 bg-primary-100 dark:bg-primary-900 text-primary-600 dark:text-primary-300 rounded-lg">
                                <i class="fas fa-clock text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">სამუშაო დრო</p>
                                <p class="font-medium text-gray-900 dark:text-gray-100">{{ $employee->worktime->label() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-xl">
                        <div class="flex items-center gap-3">
                            <div class="p-3 bg-primary-100 dark:bg-primary-900 text-primary-600 dark:text-primary-300 rounded-lg">
                                <i class="fas fa-money-bill text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">სასურველი ანაზღაურება</p>
                                <p class="font-medium text-gray-900 dark:text-gray-100">{{ $employee->salary }} ₾</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Experience and Qualifications -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">გამოცდილება და კვალიფიკაცია</h2>
                    <div class="prose prose-blue max-w-none dark:prose-invert">
                        {!! nl2br(e($employee->description)) !!}
                    </div>
                </div>

                <!-- Skills -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">უნარები</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach(explode(',', $employee->skills) as $skill)
                            <span class="px-4 py-2 bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 rounded-full text-sm font-medium">
                                {{ trim($skill) }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="border-t border-gray-200 dark:border-gray-700 pt-8">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">საკონტაქტო ინფორმაცია</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex items-center gap-3">
                            <div class="p-3 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 rounded-lg">
                                <i class="fas fa-envelope text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">ელ-ფოსტა</p>
                                <a href="mailto:{{ $employee->email }}" class="font-medium text-primary-600 dark:text-primary-400 hover:underline">{{ $employee->email }}</a>
                            </div>
                        </div>
                        @if($employee->phone)
                        <div class="flex items-center gap-3">
                            <div class="p-3 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 rounded-lg">
                                <i class="fas fa-phone text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">ტელეფონი</p>
                                <a href="tel:{{ $employee->phone }}" class="font-medium text-primary-600 dark:text-primary-400 hover:underline">{{ $employee->phone }}</a>
                            </div>
                        </div>
                        @endif
                        @if($employee->website)
                        <div class="flex items-center gap-3">
                            <div class="p-3 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 rounded-lg">
                                <i class="fas fa-globe text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">ვებსაიტი</p>
                                <a href="{{ $employee->website }}" target="_blank" class="font-medium text-primary-600 dark:text-primary-400 hover:underline">{{ $employee->website }}</a>
                            </div>
                        </div>
                        @endif
                        @if($employee->social)
                        <div class="flex items-center gap-3">
                            <div class="p-3 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 rounded-lg">
                                <i class="fas fa-share-nodes text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">სოციალური ქსელები</p>
                                <div class="flex flex-col gap-2 mt-1">
                                    @foreach(explode(',', $employee->social) as $socialLink)
                                        <a href="{{ trim($socialLink) }}" target="_blank" class="flex items-center gap-2 text-gray-500 hover:text-primary-600 dark:hover:text-primary-400">
                                            <i class="fa-solid fa-globe"></i>
                                            <span>{{ trim($socialLink) }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Posted Date -->
                <div class="mt-8 text-sm text-gray-500 dark:text-gray-400">
                    <p>გამოქვეყნებულია: {{ $employee->created_at->format('Y-m-d H:i') }} ({{ $employee->created_at->diffForHumans() }})</p>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-8">
            <a href="{{ route('jobs') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-lg transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i> უკან დაბრუნება
            </a>
        </div>
    </div>
</x-layout>