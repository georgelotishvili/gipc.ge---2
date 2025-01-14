<div class="col-span-1 md:col-span-2 lg:col-span-4">
    <div wire:poll.5s="fetchExamRequests" class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
        <div class="flex flex-col items-center">
            <div class="p-4 rounded-full bg-blue-100 mb-4">
                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-6">გამოცდა</h2>
            
            <div class="flex flex-col items-center space-y-4">
                @if(!$examRequests)
                    <button wire:click="requestExam" class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200 font-medium">
                        გამოცდის მოთხოვნა
                    </button>
                @endif
                
                @if($approvedExamRequest)
                    <button wire:click="startExam" class="px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors duration-200 font-medium">
                        გამოცდის დაწყება
                    </button>
                @endif
                
                @if($nonApprovedExamRequest)
                    <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <p class="text-yellow-700 text-center">
                            გამოცდა მოთხოვნილია, გთხოვთ დაელოდოთ
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
