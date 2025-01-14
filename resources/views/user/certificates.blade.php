<x-user.layout>
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12 mt-4">
        @foreach(auth()->user()->examRequests as $examRequest)
            @if(!$examRequest->test)
                @continue
            @endif
            <div class="bg-white rounded-xl shadow-md overflow-hidden cursor-pointer" onclick="window.location.href = '{{ route('result', $examRequest->test->id) }}'">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-semibold text-gray-800">ტესტი #{{ $examRequest->test->id }}</h3>
                        <span class="px-3 py-1 text-sm font-medium rounded-full {{ $examRequest->test->score >= 50 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $examRequest->test->score }}%
                        </span>
                    </div>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between items-center text-gray-600">
                            <span>სულ კითხვები:</span>
                            <span class="font-medium">{{ $examRequest->test->questions_count }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center text-gray-600">
                            <span>სწორი პასუხები:</span>
                            <span class="font-medium text-green-600">{{ $examRequest->test->correct_answers_count }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center text-gray-600">
                            <span>არასწორი პასუხები:</span>
                            <span class="font-medium text-red-600">{{ $examRequest->test->incorrect_answers_count }}</span>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-100">
                        <div class="text-sm text-gray-500">
                            თარიღი: {{ $examRequest->test->created_at->format('Y-m-d H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        
    </div>
</x-user.layout>
