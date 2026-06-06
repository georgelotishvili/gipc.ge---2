<x-admin.layout>
    <div class="min-h-screen bg-white dark:bg-dark-2">
        <div class="max-w-7xl mx-auto px-6 py-8">
            <!-- Header -->
            <div class="flex items-center justify-between mb-12">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">კურსები</h1>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">მართეთ თქვენი სასწავლო მასალები</p>
                </div>
                <a href="{{ route('admin.courses.create') }}" 
                   class="px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-md transition-colors">
                    + ახალი კურსი
                </a>
            </div>

            @if($courses->count() > 0)
                <!-- Courses Grid -->
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach($courses as $course)
                    <div class="bg-white dark:bg-dark-3 rounded-md border border-gray-200 dark:border-dark-4 overflow-hidden hover:shadow-md transition-shadow">
                        <!-- Image -->
                        <div class="aspect-video bg-gray-100 dark:bg-dark-4 relative">
                            @if($course->image()->first())
                                <a href="{{ route('admin.courses.chapters', $course->id) }}">
                                    <img src="{{ Storage::url($course->image()->first()->path) }}" 
                                         alt="{{ $course->name }}" 
                                         class="w-full h-full object-cover">
                                </a>
                            @else
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Content -->
                        <div class="p-5">
                            <h3 class="font-semibold text-gray-900 dark:text-white text-lg mb-2">
                                <a href="{{ route('admin.courses.edit', $course->id) }}" class="hover:text-primary-600 transition-colors">
                                    {{ $course->name }}
                                </a>
                            </h3>
                            
                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 line-clamp-2">
                                {{ $course->description }}
                            </p>
                            
                            <!-- Stats -->
                            <div class="flex items-center gap-4 mb-4 text-sm text-gray-500 dark:text-gray-400">
                                <span>{{ $course->chapters_count ?? 0 }} თავი</span>
                                <span>{{ $course->videos_count ?? 0 }} ვიდეო</span>
                            </div>
                            
                            <!-- Actions -->
                            <div class="flex gap-2">
                                <a href="{{ route('admin.courses.edit', $course->id) }}" 
                                   class="flex-1 px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md text-center transition-colors">
                                    რედაქტირება
                                </a>
                                <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-full px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md transition-colors"
                                            onclick="return confirm('დარწმუნებული ხართ?')">
                                        წაშლა
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="w-16 h-16 bg-gray-100 dark:bg-dark-4 rounded-md flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">კურსები არ არის</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">დაიწყეთ პირველი კურსის შექმნით</p>
                    <a href="{{ route('admin.courses.create') }}" 
                       class="px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-md transition-colors">
                        კურსის დამატება
                    </a>
                </div>
            @endif
        </div>
    </div>

    @push('styles')
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
    @endpush
</x-admin.layout>
