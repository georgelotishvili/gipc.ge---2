<div class="col-span-1 md:col-span-2 lg:col-span-4">
    <div wire:poll.5s="fetchExamRequests" 
         class="bg-white dark:bg-dark-2 rounded-3xl border border-gray-100 dark:border-gray-800 p-8">
        <!-- Header -->
        <div class="flex flex-col items-center">
            <div class="p-4 rounded-2xl bg-gradient-to-br from-primary-50 to-primary-100/50 dark:from-primary-400/10 dark:to-primary-400/5 mb-4">
                <svg class="w-8 h-8 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
            </div>
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90 mb-6">წინასაგამოცდო ტესტი</h2>
            
            <!-- Action Buttons -->
            <div class="flex flex-col items-center space-y-4 w-full max-w-sm">
                {{-- @if(!$examRequests)
                    <button wire:click="requestExam" 
                            class="w-full px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-2xl font-medium 
                                   focus:ring-4 focus:ring-primary-100 dark:focus:ring-primary-400/20
                                   transform active:scale-[0.98] transition-all duration-200
                                   disabled:opacity-70 disabled:cursor-not-allowed">
                        წინასაგამოცდო ტესტის მოთხოვნა
                    </button>
                @endif --}}
                
                <button wire:click="startExam" 
                        class="w-full px-6 py-3 bg-green-500 hover:bg-green-600 text-white rounded-2xl font-medium 
                                disabled:opacity-70 disabled:cursor-not-allowed">
                    წინასაგამოცდო ტესტის @if($approvedExamRequest) გაგრძელება @else დაწყება @endif
                </button>
                @if($approvedExamRequest)
                    <button wire:click="cancelExam" 
                            class="w-full px-6 py-3 bg-red-500 hover:bg-red-600 text-white rounded-2xl font-medium 
                                   focus:ring-4 focus:ring-red-100 dark:focus:ring-red-400/20
                                   transform active:scale-[0.98] transition-all duration-200
                                   disabled:opacity-70 disabled:cursor-not-allowed">
                        გამოცდის გაუქმება
                    </button>
                @endif
                
                @if($nonApprovedExamRequest)
                    <div class="w-full p-4 bg-yellow-50 dark:bg-yellow-400/10 border border-yellow-100 dark:border-yellow-400/20 rounded-2xl">
                        <div class="flex items-center gap-3">
                            <div class="flex-shrink-0 p-2 rounded-xl bg-yellow-100 dark:bg-yellow-400/20">
                                <svg class="w-4 h-4 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>
                            <p class="text-sm text-yellow-800 dark:text-yellow-300 font-medium">
                                გამოცდა მოთხოვნილია, გთხოვთ დაელოდოთ
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
