<x-layout>
    <div class="min-h-screen bg-gray-100 py-8 mt-16">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-blue-600 px-6 py-4">
                <h1 class="text-2xl font-bold text-white">ტესტის შედეგი</h1>
            </div>
            
            <div class="p-6">
                <div class="mb-8 text-center">
                    <div class="text-6xl font-bold {{ $score >= 50 ? 'text-green-600' : 'text-red-600' }}">
                        {{ $score }}%
                    </div>
                    <p class="text-gray-600 mt-2 text-xl">შედეგი</p>
                    <p class="text-2xl mt-2">
                        {{ $correctAnswers }} სწორი პასუხი {{ $totalQuestions }} კითხვიდან
                    </p>
                </div>

                <div class="space-y-6">
                    @foreach($questions as $question)
                        <div class="border rounded-lg p-4 shadow-md">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    @if($question->answers->where('id', $question->pivot->answer)->first()?->is_true)
                                        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    @else
                                        <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold text-lg">{{ $question->text }}</p>
                                    <div class="mt-3 text-base space-y-2">
                                        @foreach($question->answers as $answer)
                                            <div class="relative">
                                                @if($answer->id == $question->pivot->answer)
                                                    <p class="py-2 px-4 rounded-md text-lg font-medium {{ $answer->is_true ? 'bg-green-100 border border-green-500 shadow-sm transform scale-102' : 'bg-red-100 border border-red-500 shadow-sm transform scale-102' }}">
                                                        {{ $answer->text }}
                                                    </p>
                                                @else
                                                    <p class="py-2 px-4 rounded-md text-base text-gray-600 hover:bg-gray-50 transition-colors">
                                                        {{ $answer->text }}
                                                    </p>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8 text-center">
                    <a href="{{ route('exam') }}" class="inline-block bg-blue-600 text-white px-6 py-2 text-lg rounded-lg hover:bg-blue-700 transition-all transform hover:scale-102 font-medium">
                        ახალი ტესტი დაწყება
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout>