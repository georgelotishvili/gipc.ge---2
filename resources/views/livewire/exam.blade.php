<div>
    @if($test)
        @if($test->active)
            <div class="relative flex flex-col min-h-screen bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-900 dark:to-black text-gray-900 dark:text-white font-sans">
                
                <!-- Header Area -->
                <header class="absolute top-0 left-0 right-0 p-4 z-20 flex justify-between items-center">
                    <!-- Group Title Tag -->
                    <span class="text-xs font-semibold text-indigo-700 dark:text-indigo-300 bg-indigo-100 dark:bg-indigo-900/50 px-2 py-1 rounded-full border border-indigo-200 dark:border-indigo-800 shadow-sm">
                        {{ $question->groups->first()->title }}
                    </span>
                    <!-- Timer Display -->
                    <div class="flex items-center gap-2 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm shadow-lg px-4 py-1.5 rounded-full border border-gray-200 dark:border-gray-700">
                        <svg class="h-5 w-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span wire:poll.1000ms="updateTimer" class="text-xs sm:text-sm font-semibold text-gray-900 dark:text-white">{{ $timer }}</span>
                    </div>
                </header>

                <!-- Main Content Area (Flex grow to push footer down) -->
                <main class="flex-grow flex flex-col items-center justify-center px-4 pt-24 pb-40 md:pt-28 md:pb-48 overflow-hidden">
                    <div class="w-full max-w-3xl lg:max-w-4xl xl:max-w-5xl flex flex-col flex-shrink min-h-0">
                        <!-- Question Text Container (Stricter height + scroll for long text) -->
                        <div class="mb-8 flex-shrink max-h-[40vh] overflow-y-auto p-1 rounded-lg scrollbar-thin scrollbar-thumb-gray-400 dark:scrollbar-thumb-gray-600 scrollbar-track-transparent">
                            <h1 class="text-sm sm:text-base md:text-lg lg:text-xl font-bold leading-tight text-center">
                                {{ $question->text }}
                            </h1>
                        </div>

                        <!-- Answer Options -->
                        <div class="space-y-4">
                            @php
                                $currentAnswer = $testQuestion->where('test_id', $test->id)->where('question_id', $question->id)->first()?->answer;
                            @endphp
                            
                            @foreach($question->answers as $answer)
                                @php
                                    $isSelected = $currentAnswer == $answer->id;
                                    $isCorrect = $answer->is_true;
                                @endphp
                                
                                <button 
                                    wire:click="answer({{ $answer->id }})" 
                                    wire:loading.attr="disabled"
                                    @if($currentAnswer) disabled @endif
                                    class="w-full group flex items-center py-2 sm:py-3 md:py-4 px-3 sm:px-4 md:px-6 border rounded-xl shadow-sm text-left transition-all duration-300 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-900
                                    @if($isSelected)
                                        @if($isCorrect)
                                            bg-emerald-500 dark:bg-emerald-600 text-white border-transparent
                                        @else
                                            bg-red-500 dark:bg-red-600 text-white border-transparent
                                        @endif
                                    @else
                                        bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 border-gray-200 dark:border-gray-700 hover:border-primary-300 dark:hover:border-primary-600 hover:bg-gray-50 dark:hover:bg-gray-700/50
                                    @endif">
                                    <div class="flex-1">
                                        <span class="font-medium text-xs sm:text-sm md:text-base">{{ $answer->text }}</span>
                                    </div>
                                    <div class="ml-4 flex-shrink-0 transition-opacity duration-300 @if(!$isSelected) opacity-0 group-hover:opacity-100 @endif">
                                        @if($isSelected)
                                            @if($isCorrect)
                                                <div class="w-7 h-7 rounded-full bg-white/30 flex items-center justify-center">
                                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </div>
                                            @else
                                                 <div class="w-7 h-7 rounded-full bg-white/30 flex items-center justify-center">
                                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        @else
                                            <svg class="h-6 w-6 text-primary-500 dark:text-primary-400 opacity-50 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        @endif
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </main>

                <!-- Footer Area (Fixed at bottom) -->
                <footer class="fixed bottom-0 left-0 right-0 bg-white/90 dark:bg-gray-800/90 backdrop-blur-md shadow-[0_-4px_20px_rgba(0,0,0,0.05)] dark:shadow-[0_-4px_20px_rgba(0,0,0,0.2)] z-20 border-t border-gray-200 dark:border-gray-700"
                        x-data="{ expanded: false }">
                    
                    <!-- Collapsible Header (Always Visible) -->
                    <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex justify-between items-center">
                            <!-- Progress Percentage -->
                            <span class="text-xs font-semibold text-primary-600 dark:text-primary-400">{{ number_format($progress, 0) }}% Complete</span>
                            
                            <!-- Expand/Collapse Button -->
                            <button @click="expanded = !expanded" 
                                    class="p-2 rounded-full text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500">
                                <svg class="w-5 h-5 transition-transform duration-200" 
                                     :class="{ 'rotate-180': expanded }"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Expandable Content -->
                    <div x-show="expanded" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 transform translate-y-0"
                         x-transition:leave-end="opacity-0 transform -translate-y-2"
                         class="px-4 py-4">
                        
                        <!-- Navigation Controls -->
                        <div class="flex justify-between items-center mb-4">
                            <!-- Previous Button -->
                            <button type="button" wire:click="previousQuestion"
                                    wire:loading.attr="disabled"
                                    class="p-3 rounded-full text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            
                            <!-- Next / Finish Button -->
                            @if ($progress == 100)
                                <a href="{{ route('result', $test->id) }}" 
                                    class="p-3 rounded-full text-white bg-gradient-to-r from-emerald-500 to-green-500 hover:from-emerald-600 hover:to-green-600 shadow-md hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 dark:focus:ring-offset-gray-800">
                                     <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                     </svg>
                                 </a>
                            @else
                                <button type="button" wire:click="nextQuestion"
                                        wire:loading.attr="disabled"
                                        class="p-3 rounded-full text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            @endif
                        </div>

                        <!-- Progress Bar -->
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 overflow-hidden mb-4">
                            <div 
                                x-data="{ width: 0 }" 
                                x-init="width = {{ $progress }}"
                                x-bind:style="`width: ${width}%`"
                                x-effect="width = {{ $progress }}"
                                class="bg-gradient-to-r from-primary-500 to-indigo-500 dark:from-primary-400 dark:to-indigo-400 h-full transition-all duration-500 ease-out">
                            </div>
                        </div>

                        <!-- Question Navigation Dots -->
                        <div class="flex flex-wrap justify-center gap-2">
                            @foreach($test->questions()->orderBy('id')->get() as $q)
                                @php
                                    $qAnswer = $testQuestion->where('test_id', $test->id)->where('question_id', $q->id)->first()?->answer;
                                    $qIsCorrect = $qAnswer ? $q->answers->find($qAnswer)?->is_true : null;
                                @endphp
                                <span wire:click="goToQuestion({{ $q->id }})" 
                                      title="Question {{ $loop->iteration }}"
                                      class="w-3 h-3 cursor-pointer transition-all duration-300 ease-in-out hover:scale-125 flex items-center justify-center rounded-sm
                                    @if($q->id == $question->id)
                                        transform rotate-45 bg-primary-500 dark:bg-primary-400 scale-110 ring-1 ring-primary-500/50 dark:ring-primary-400/50
                                    @elseif($qAnswer)
                                        @if($qIsCorrect)
                                            bg-emerald-500 dark:bg-emerald-400 opacity-70
                                        @else
                                            bg-red-500 dark:bg-red-400 opacity-70
                                        @endif
                                    @else
                                        bg-gray-300 dark:bg-gray-600 opacity-50 hover:opacity-75
                                    @endif">
                                </span>
                            @endforeach
                        </div>
                    </div>
                </footer>
                
                <!-- Loading Indicator Removed -->
                
                {{-- Removed JS Timer Block as Livewire poll handles it --}}
            </div>
        @endif
    @endif
    
    <script>
        // Listen for the goToNextQuestion event and smoothly transition
        document.addEventListener('livewire:init', () => {
            Livewire.on('goToNextQuestion', (event) => {
                // Add a small delay to prevent flickering
                setTimeout(() => {
                    @this.goToQuestionAfterAnswer(event.questionId);
                }, 300);
            });
        });
    </script>
</div>
