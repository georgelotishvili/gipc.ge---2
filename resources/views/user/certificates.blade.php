<x-user.layout>
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12 mt-4">
        @foreach(auth()->user()->examRequests as $examRequest)
            @if(!$examRequest->test)
                @continue
            @endif
            <div class="bg-white dark:bg-dark-2 rounded-2xl border border-gray-100 dark:border-gray-800 hover:border-primary-100 dark:hover:border-primary-400/20 transition-all duration-200 group"
                 onclick="window.location.href = '{{ route('result', $examRequest->test->id) }}'">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="p-3 rounded-xl bg-primary-50 dark:bg-primary-400/10 group-hover:bg-primary-100 dark:group-hover:bg-primary-400/20 transition-colors duration-200">
                                <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">ტესტი #{{ $examRequest->test->id }}</h3>
                        </div>
                        <span class="px-3 py-1.5 text-sm font-medium rounded-full {{ $examRequest->test->score >= 50 
                            ? 'bg-green-50 text-green-700 dark:bg-green-400/10 dark:text-green-400' 
                            : 'bg-red-50 text-red-700 dark:bg-red-400/10 dark:text-red-400' }}">
                            {{ $examRequest->test->score }}%
                        </span>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 dark:text-gray-400">სულ კითხვები</span>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $examRequest->test->questions_count }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 dark:text-gray-400">სწორი პასუხები</span>
                            <span class="font-medium text-green-600 dark:text-green-400">{{ $examRequest->test->correct_answers_count }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 dark:text-gray-400">არასწორი პასუხები</span>
                            <span class="font-medium text-red-600 dark:text-red-400">{{ $examRequest->test->incorrect_answers_count }}</span>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-800">
                        <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $examRequest->test->created_at->format('Y-m-d H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-user.layout>
