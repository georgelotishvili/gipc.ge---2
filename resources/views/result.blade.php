<x-user.layout>
    <div class="min-h-screen py-8 mt-12 sm:mt-16 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-900 dark:to-black">
        <div class="max-w-4xl mx-auto px-4">
            <!-- Score Card -->
            <div class="bg-white dark:bg-gray-800/50 backdrop-blur-md rounded-2xl border border-gray-200 dark:border-gray-700/50 p-8 sm:p-10 mb-10 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="flex flex-col items-center">
                    <!-- Result Badge -->
                    <div class="mb-6">
                        <span class="px-8 py-3 rounded-full text-md font-semibold {{ $score >= 50 
                            ? 'bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-700'
                            : 'bg-red-100 dark:bg-red-900/50 text-red-700 dark:text-red-300 border border-red-200 dark:border-red-700' }}">
                            {{ $score >= 50 ? '✅ გავიდა' : 'სამწუხაროდ თქვენ ვერ ჩააბარეთ' }} <!-- Passed / Failed -->
                        </span>
                    </div>
                    
                    <!-- Score Circle -->
                    <div class="mb-8 relative w-40 h-40 sm:w-48 sm:h-48">
                        <svg class="absolute inset-0 w-full h-full" viewBox="0 0 100 100">
                            <!-- Background track -->
                            <circle 
                                cx="50" 
                                cy="50" 
                                r="45" 
                                fill="none" 
                                stroke="currentColor" 
                                stroke-width="8" 
                                class="text-gray-200 dark:text-gray-700 opacity-50"
                            />
                            <!-- Progress arc -->
                            <circle 
                                cx="50" 
                                cy="50" 
                                r="45" 
                                fill="none" 
                                stroke="url(#scoreGradient)" 
                                stroke-width="8" 
                                stroke-linecap="round"
                                stroke-dasharray="{{ 2 * pi() * 45 }}" 
                                stroke-dashoffset="{{ (2 * pi() * 45) * (1 - $score / 100) }}" 
                                transform="rotate(-90 50 50)" 
                            />
                            <!-- Gradient Definition -->
                            <defs>
                                <linearGradient id="scoreGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                    @if($score >= 50)
                                        <stop offset="0%" style="stop-color:#10b981; stop-opacity:1" />
                                        <stop offset="100%" style="stop-color:#34d399; stop-opacity:1" />
                                    @else
                                        <stop offset="0%" style="stop-color:#ef4444; stop-opacity:1" />
                                        <stop offset="100%" style="stop-color:#f87171; stop-opacity:1" />
                                    @endif
                                </linearGradient>
                            </defs>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-5xl sm:text-6xl font-bold 
                                {{ $score >= 50 ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-600 dark:text-red-400' }}">
                                {{ $score }}<span class="text-2xl">%</span>
                            </span>
                        </div>
                    </div>

                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-3">
                        ტესტის შედეგი <!-- Test Result -->
                    </h2>
                    <p class="text-lg text-gray-600 dark:text-gray-400 mb-8">
                        {{ $correctAnswers }} სწორი პასუხი {{ $totalQuestions }} კითხვიდან <!-- Correct answers out of total -->
                    </p>
                    
                    <!-- Stats Grid -->
                    <div class="grid grid-cols-3 gap-4 sm:gap-6 w-full max-w-md border-t border-gray-200 dark:border-gray-700 pt-6">
                        <div class="text-center">
                            <span class="block text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">კითხვები</span>
                            <span class="block text-2xl font-bold text-gray-900 dark:text-white">{{ $totalQuestions }}</span>
                        </div>
                        <div class="text-center">
                            <span class="block text-xs uppercase tracking-wider text-emerald-600 dark:text-emerald-400 mb-1">სწორი</span>
                            <span class="block text-2xl font-bold text-emerald-600 dark:text-emerald-400">{{ $correctAnswers }}</span>
                        </div>
                        <div class="text-center">
                            <span class="block text-xs uppercase tracking-wider text-red-600 dark:text-red-400 mb-1">არასწორი</span>
                            <span class="block text-2xl font-bold text-red-600 dark:text-red-400">{{ $totalQuestions - $correctAnswers }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Questions List Title -->
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 mt-12">კითხვების გარჩევა</h3> <!-- Question Breakdown -->

            <!-- Questions List -->
            <div class="space-y-6">
                @foreach($questions as $question)
                    @php
                        $userAnswerId = $question->pivot->answer;
                        $userAnswer = $question->answers->find($userAnswerId);
                        $isUserCorrect = $userAnswer?->is_true ?? false;
                    @endphp
                    <div class="bg-white dark:bg-gray-800/50 backdrop-blur-sm rounded-xl border border-gray-200 dark:border-gray-700/50 shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
                        <!-- Question Header -->
                        <div class="p-5 sm:p-6 border-b border-gray-200 dark:border-gray-700/50 flex items-start gap-4">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-10 h-10 rounded-lg flex items-center justify-center {{ $isUserCorrect ? 'bg-emerald-100 dark:bg-emerald-900/30' : 'bg-red-100 dark:bg-red-900/30' }}">
                                    @if($isUserCorrect)
                                        <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    @else
                                        <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <p class="text-base sm:text-lg font-medium text-gray-900 dark:text-white">{{ $question->text }}</p>
                                <span class="mt-1 inline-block text-xs font-medium text-indigo-700 dark:text-indigo-300 bg-indigo-100 dark:bg-indigo-900/50 px-2 py-0.5 rounded-md">
                                    {{ $question->groups->first()->title ?? 'General' }}
                                </span>
                            </div>
                        </div>

                        <!-- Answers Section -->
                        <div class="p-5 sm:p-6 bg-gray-50 dark:bg-gray-800/20">
                            <div class="space-y-3">
                                @foreach($question->answers as $answer)
                                    @php
                                        $isSelectedByUser = $answer->id == $userAnswerId;
                                        $isTheCorrectAnswer = $answer->is_true;
                                    @endphp
                                    <div @class([
                                        'flex items-center justify-between p-4 rounded-lg border',
                                        'bg-emerald-50 dark:bg-emerald-900/30 border-emerald-200 dark:border-emerald-700' => $isSelectedByUser && $isTheCorrectAnswer,
                                        'bg-red-50 dark:bg-red-900/30 border-red-200 dark:border-red-700' => $isSelectedByUser && !$isTheCorrectAnswer,
                                        'bg-green-50 dark:bg-green-900/20 border-green-200 dark:border-green-700/50' => !$isSelectedByUser && $isTheCorrectAnswer, // Highlight correct if user was wrong
                                        'bg-white dark:bg-gray-700/40 border-gray-200 dark:border-gray-600/50' => !$isSelectedByUser && !$isTheCorrectAnswer, 
                                    ])>
                                        <p @class([
                                            'text-sm sm:text-base',
                                            'font-semibold text-emerald-800 dark:text-emerald-200' => $isSelectedByUser && $isTheCorrectAnswer,
                                            'font-semibold text-red-800 dark:text-red-200 line-through' => $isSelectedByUser && !$isTheCorrectAnswer,
                                            'font-semibold text-green-800 dark:text-green-300' => !$isSelectedByUser && $isTheCorrectAnswer,
                                            'text-gray-700 dark:text-gray-300' => !$isSelectedByUser && !$isTheCorrectAnswer,
                                        ])>
                                            {{ $answer->text }}
                                        </p>
                                        <div class="flex-shrink-0 ml-4">
                                            @if($isSelectedByUser && $isTheCorrectAnswer)
                                                <span class="text-xs font-medium text-emerald-600 dark:text-emerald-400">(თქვენი პასუხი)</span>
                                            @elseif($isSelectedByUser && !$isTheCorrectAnswer)
                                                <span class="text-xs font-medium text-red-600 dark:text-red-400">(თქვენი პასუხი)</span>
                                            @elseif($isTheCorrectAnswer)
                                                 <span class="text-xs font-medium text-green-600 dark:text-green-400">(სწორი პასუხი)</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Back Button -->
            <div class="mt-10 flex justify-center">
                <a href="{{ route('test_results') }}" 
                   class="inline-flex items-center gap-2 text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-500 dark:hover:bg-primary-600 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-800 font-medium rounded-lg text-sm px-6 py-3 transition-all duration-200 focus:outline-none shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>ყველა შედეგის ნახვა</span> <!-- See All Results -->
                </a>
            </div>
        </div>
    </div>
</x-user.layout>