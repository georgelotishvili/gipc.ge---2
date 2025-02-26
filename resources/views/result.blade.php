<x-user.layout>
    <div class="min-h-screen py-4 sm:py-8 mt-12 sm:mt-16">
        <div class="max-w-4xl mx-auto px-4">
            <!-- Score Card -->
            <div class="bg-white dark:bg-dark-2 rounded-2xl border border-gray-100 dark:border-gray-800 p-6 sm:p-12 mb-8 sm:mb-12">
                <div class="flex flex-col items-center">
                    <!-- Score Circle -->
                    <div class="mb-6 sm:mb-8">
                        <div class="w-28 h-28 sm:w-40 sm:h-40 flex items-center justify-center 
                            {{ $score >= 50 
                                ? 'bg-green-50 dark:bg-green-400/5' 
                                : 'bg-red-50 dark:bg-red-400/5' }} 
                            rounded-full border-2 
                            {{ $score >= 50 
                                ? 'border-green-200 dark:border-green-400/20' 
                                : 'border-red-200 dark:border-red-400/20' }}">
                            <span class="text-5xl sm:text-7xl font-bold 
                                {{ $score >= 50 
                                    ? 'text-green-600 dark:text-green-400' 
                                    : 'text-red-600 dark:text-red-400' }}">
                                {{ $score }}%
                            </span>
                        </div>
                    </div>

                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mb-2 sm:mb-3">
                        ტესტის შედეგი
                    </h2>
                    <p class="text-lg sm:text-xl text-gray-600 dark:text-gray-300">
                        {{ $correctAnswers }} სწორი პასუხი {{ $totalQuestions }} კითხვიდან
                    </p>
                </div>
            </div>

            <!-- Questions List -->
            <div class="space-y-6 sm:space-y-8">
                @foreach($questions as $question)
                    <div class="bg-white dark:bg-dark-2 rounded-2xl border border-gray-100 dark:border-gray-800">
                        <!-- Question Header -->
                        <div class="p-5 sm:p-8">
                            <div class="flex items-start gap-4 sm:gap-6">
                                <div class="flex-shrink-0 mt-1">
                                    @if($question->answers->where('id', $question->pivot->answer)->first()?->is_true)
                                        <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl bg-green-50 dark:bg-green-400/5 flex items-center justify-center">
                                            <svg class="w-6 h-6 sm:w-7 sm:h-7 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                    @else
                                        <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl bg-red-50 dark:bg-red-400/5 flex items-center justify-center">
                                            <svg class="w-6 h-6 sm:w-7 sm:h-7 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <p class="text-base sm:text-xl font-medium text-gray-900 dark:text-white">{{ $question->text }}</p>
                            </div>
                        </div>

                        <!-- Answers -->
                        <div class="p-5 sm:p-8 pt-2 sm:pt-4">
                            <div class="space-y-3 sm:space-y-4">
                                @foreach($question->answers as $answer)
                                    <div>
                                        @if($answer->id == $question->pivot->answer)
                                            <div class="p-4 sm:p-5 rounded-xl {{ $answer->is_true 
                                                ? 'bg-green-50 dark:bg-green-400/5 border border-green-200 dark:border-green-400/20' 
                                                : 'bg-red-50 dark:bg-red-400/5 border border-red-200 dark:border-red-400/20' }}">
                                                <p class="text-base sm:text-lg {{ $answer->is_true 
                                                    ? 'text-green-900 dark:text-green-300' 
                                                    : 'text-red-900 dark:text-red-300' }}">
                                                    {{ $answer->text }}
                                                </p>
                                            </div>
                                        @else
                                            <div class="p-4 sm:p-5 rounded-xl bg-gray-50 dark:bg-dark-4 border border-gray-100 dark:border-gray-800">
                                                <p class="text-base sm:text-lg text-gray-600 dark:text-gray-400">{{ $answer->text }}</p>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Back Button -->
            <div class="mt-8 sm:mt-12 text-center">
                <a href="{{ route('workspace') }}" 
                   class="inline-flex items-center gap-2 sm:gap-3 px-6 sm:px-8 py-3 sm:py-4 bg-primary-600 hover:bg-primary-700
                          text-white text-base sm:text-lg rounded-xl font-medium">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    სამუშაო სივრცე
                </a>
            </div>
        </div>
    </div>
</x-user.layout>