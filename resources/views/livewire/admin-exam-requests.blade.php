<div class="mb-8">
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 3xl:grid-cols-4 gap-4 sm:gap-5 lg:gap-6">
        @foreach($examRequests->sortByDesc('created_at') as $request)
            <div class="bg-white/80 dark:bg-dark-2/50 backdrop-blur-xl rounded-xl p-4 shadow-[0_2px_8px_rgb(0,0,0,0.08)] border border-gray-100/50 dark:border-dark-4/50 transition-all duration-300 hover:shadow-[0_8px_30px_rgb(0,0,0,0.12)]">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center">
                        <div class="h-9 w-9 flex-shrink-0 rounded-xl bg-gradient-to-br from-blue-500/20 to-blue-600/20 dark:from-blue-500/30 dark:to-blue-600/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <span class="text-blue-600 dark:text-blue-400 font-semibold text-sm">
                                {{ substr($request->user->name, 0, 2) }}
                            </span>
                        </div>
                        <div class="ml-3">
                            <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                {{ $request->user->name }}
                            </div>
                        </div>
                    </div>
                    <span class="px-2.5 py-1 text-xs font-medium rounded-lg bg-gradient-to-r from-violet-500/10 to-violet-600/10 text-violet-600 dark:text-violet-400 border border-violet-500/20">
                        არქიტექტურული
                    </span>
                </div>
                
                <div class="space-y-2 mb-4">
                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ $request->created_at->format('Y-m-d H:i') }}
                    </div>
                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                        </svg>
                        ID: {{ $request->id }}
                    </div>
                </div>

                <div class="flex justify-end">
                    @if($request->approved)
                        <button 
                            wire:click="cancelRequest({{ $request->id }})"
                            class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-red-600 to-red-500 text-white text-sm font-medium rounded-xl hover:from-red-700 hover:to-red-600 transition-all duration-300 hover:-translate-y-0.5">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            გაუქმება
                        </button>
                    @else
                        <button 
                            wire:click="approveRequest({{ $request->id }})"
                            class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-emerald-600 to-emerald-500 text-white text-sm font-medium rounded-xl hover:from-emerald-700 hover:to-emerald-600 transition-all duration-300 hover:-translate-y-0.5">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            დამტკიცება
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

