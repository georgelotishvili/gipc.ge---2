<div>
        @if($test)
            @if($test->active)
            
                <!-- ====== Questions Section Start -->
                <div class="relative z-10 overflow-hidden pb-[60px] pt-[120px] md:pt-[130px] lg:pt-[160px] dark:bg-dark">
                    <div class="container mx-auto px-4">
                        <h1 class="mb-6 text-2xl text-center font-bold text-dark dark:text-white sm:text-xl md:text-[24px] md:leading-[1.2] max-w-3xl mx-auto">
                            {{ $question->text }}
                        </h1>
                        <p class="text-center text-sm text-gray-500 dark:text-gray-400 mb-2">{{ $question->groups->first()->title }}</p>
                        <p class="timer text-center mb-8 text-lg dark:text-white"></p>
                        <div class="flex flex-col items-center">
                            <div class="w-full max-w-2xl mb-8">
                                @foreach($question->answers as $answer)
                                {{-- {{dd($question->pivot)}} --}}
                                    <button @if(!$testQuestion->where('test_id', $test->id)->where('question_id', $question->id)->first()->answer) wire:click="answer({{ $answer->id }})" @endif
                                        class="w-full font-semibold py-3 px-6 mb-4 border border-gray-300 dark:border-dark-4 rounded-lg shadow-lg text-left transition-colors duration-200 hover:bg-gray-100 dark:bg-dark-2 dark:text-white dark:hover:bg-dark-4
                                        @if($testQuestion->where('test_id', $test->id)->where('question_id', $question->id)->first()->answer == $answer->id)
                                            @if($answer->is_true)
                                                bg-emerald-500 dark:bg-emerald-600 text-white hover:bg-emerald-600 dark:hover:bg-emerald-700
                                            @else
                                                bg-red-500 dark:bg-red-600 text-white hover:bg-red-600 dark:hover:bg-red-700
                                            @endif
                                        @endif">
                                        {{ $answer->text }}
                                    </button>
                                @endforeach
                            </div>
                            <div class="flex justify-between items-center w-full max-w-2xl mb-4">
                                <button type="button" wire:click="previousQuestion"
                                    class="text-white bg-primary hover:bg-blue-600 dark:bg-primary-600 dark:hover:bg-primary-700 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 transition-colors duration-200 focus:outline-none">
                                    <i class="fa-solid fa-chevron-left fa-lg"></i>
                                </button>
                                <div class="w-3/4 bg-gray-200 dark:bg-dark-4 rounded-full h-2.5">
                                    <div x-data="{ width: 0 }" 
                                         x-init="width = {{ $progress }}"
                                         x-bind:style="`width: ${width}%`"
                                         x-effect="width = {{ $progress }}"
                                         class="bg-primary dark:bg-primary-600 h-2.5 rounded-full transition-all duration-300 ease-in-out">
                                    </div>
                                </div>
                                    @if ($progress == 100)
                                        {{-- <a href="{{ route('result') }}"
                                            class="text-white bg-primary hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 transition-colors duration-200 focus:outline-none">
                                            <i class="fa-solid fa-chevron-right fa-lg"></i>
                                        </a> --}}
                                    @else
                                        <button type="button" wire:click="nextQuestion"
                                            class="text-white bg-primary hover:bg-blue-600 dark:bg-primary-600 dark:hover:bg-primary-700 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 transition-colors duration-200 focus:outline-none">
                                            <i class="fa-solid fa-chevron-right fa-lg"></i>
                                        </button>
                                    @endif
                            </div>
                            <span class="text-sm font-medium dark:text-white">პროგრესი: {{ number_format($progress, 0) }}%</span>
                            <div class="flex justify-center">
                                @foreach($test->questions()->orderBy('id')->get() as $q)
                                    <span wire:click="goToQuestion({{ $q->id }})" id="{{ $q->id }}" class="w-3 h-3 mx-1 rounded-full cursor-pointer @if($q->id == $question->id)
                                         bg-primary dark:bg-primary-600
                                    @elseif($testQuestion->where('test_id', $test->id)->where('question_id', $q->id)->first()?->answer)
                                        @if($q->answers->find($testQuestion->where('test_id', $test->id)->where('question_id', $q->id)->first()?->answer)?->is_true)
                                            bg-emerald-500 dark:bg-emerald-600
                                        @else
                                            bg-red-500 dark:bg-red-600
                                        @endif
                                    @else
                                        bg-gray-500 dark:bg-gray-600
                                    @endif">
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <span class="absolute top-4 right-4 text-lg font-bold dark:text-white">23:14</span>
                </div>
                <!-- ====== Questions Section End -->
            @endif
        @endif
        <!-- ====== Questions Section End -->
    <script>
        let wrongAnswer = document.querySelector(".wrong-answer");
        let answer = document.querySelector(".answer");
        // let timer = document.querySelector(".timer");
        wrongAnswer.addEventListener("click", function() {
            wrongAnswer.classList.add("bg-red-500", "dark:bg-red-600", "text-white");
            answer.classList.add("bg-emerald-500", "dark:bg-emerald-600", "text-white");
        });
    
        answer.addEventListener("click", function() {
            answer.classList.add("bg-emerald-500", "dark:bg-emerald-600", "text-white");
        });
    
    
        let secs = 1800;
        let minutes = Math.floor(secs / 60);
        let countDownSecs = secs % 60;
    
        const timer = setInterval(() => {
            document.querySelector(".timer").textContent =
                `${minutes}:${countDownSecs.toString().padStart(2, '0')}`;
    
            secs--;
            minutes = Math.floor(secs / 60);
            countDownSecs = secs % 60;
    
            if (secs <= 0) {
                clearInterval(timer);
            }
        }, 1000);
    </script>
    
</div>
