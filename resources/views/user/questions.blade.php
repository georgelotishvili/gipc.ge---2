<x-layout>
    <div class="space-y-6 max-md:max-w-lg max-md:mx-auto">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 lg:gap-6">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">კითხვები</h2>
            <div class="flex flex-col md:flex-row items-start md:items-center md:justify-between lg:justify-normal gap-3 md:gap-6 w-full lg:w-auto order-last lg:order-none">
                <div class="flex flex-col md:flex-row w-full md:w-auto gap-3 md:gap-4">
                <livewire:question-search />
                    <div class="relative inline-block text-left w-full md:w-auto">
                        <button onclick="document.getElementById('filter-dropdown').classList.toggle('hidden')" class="group w-full md:w-auto px-4 py-2.5 bg-white dark:bg-dark-2 border-2 border-gray-100 dark:border-dark-4 text-gray-700 dark:text-gray-200 rounded-xl hover:border-primary- dark:hover:border-primary- transition-all duration-300 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                                </svg>
                                <span class="font-medium text-gray-700 dark:text-gray-200">ფილტრი</span>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-primary transition-all duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div id="filter-dropdown" class="hidden absolute right-0 mt-2 w-64 rounded-xl shadow-lg bg-white dark:bg-dark-2 border border-gray-100/50 dark:border-dark-4/50 overflow-hidden z-50">
                            <div class="divide-y divide-gray-100 dark:divide-dark-4">
                                <div class="px-4 py-3 bg-gray-50/50 dark:bg-dark-3/50">
                                    <span class="text-sm font-semibold text-gray-600 dark:text-gray-300">აირჩიეთ ჯგუფი</span>
                                </div>
                                <div class="py-1">
                                    @foreach ($groups as $group)
                                        <a href="{{ route('questions', ['g' => $group->name]) }}" 
                                            class="group flex items-center justify-between px-4 py-2.5 text-sm {{ request('g') == $group->name 
                                                ? 'bg-primary text-white' 
                                                : 'text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-dark-3' }} transition-all duration-200">
                                            <div class="flex items-center gap-3">
                                                <div class="h-7 w-7 rounded-lg {{ request('g') == $group->name 
                                                    ? 'bg-white/20' 
                                                    : 'bg-gray-100 dark:bg-dark-4 group-hover:bg-primary/10 dark:group-hover:bg-primary/10' }} flex items-center justify-center transition-colors duration-200">
                                                    <span class="text-xs font-medium">{{ substr($group->title, 0, 2) }}</span>
                                                </div>
                                                <span>{{$group->title}}</span>
                                            </div>
                                            <svg class="w-4 h-4 {{ request('g') == $group->name 
                                                ? 'text-white' 
                                                : 'text-gray-400 opacity-0 group-hover:opacity-100 translate-x-0 group-hover:translate-x-1' }} transition-all duration-200" 
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            @foreach($questions as $question)
                <div class="relative group bg-white dark:bg-dark-2 rounded-2xl border-2 border-gray-100 dark:border-dark-4 overflow-hidden transition-all duration-300 hover:shadow-[0_15px_30px_-15px_rgba(0,0,0,0.1)] dark:hover:shadow-[0_15px_30px_-15px_rgba(0,0,0,0.3)] hover:border-primary/30 dark:hover:border-primary/30">
                    <div class="p-4 flex flex-col md:flex-row justify-between items-start md:items-center space-y-2 md:space-y-0 md:space-x-4">
                        <div class="flex items-center">
                            <div class="flex flex-col md:flex-row items-start md:items-center w-full md:w-auto space-y-2 md:space-y-0 md:space-x-6">
                                <div class="flex justify-between w-full md:w-auto items-center space-x-4">
                                    <span class="text-gray-400 dark:text-gray-500 text-sm font-medium">#{{$question->id}}</span>
                                    <span class="px-3 py-1.5 text-xs font-medium rounded-xl bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border-2 border-indigo-100/50 dark:border-indigo-500/20">
                                        @foreach($question->groups as $group) {{$group->title}} @endforeach
                                    </span>
                                </div>
                                <p class="mt-2 md:mt-0 text-gray-900 dark:text-gray-100 cursor-pointer hover:text-primary dark:hover:text-primary transition-colors duration-300 md:flex-grow" 
                                    onclick="document.getElementById('answers-{{$question->id}}').classList.toggle('hidden')">
                                    {{$question->text}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div id="answers-{{$question->id}}" class="hidden">
                        <div class="p-4 bg-gray-50 dark:bg-dark-3 space-y-2.5 border-t-2 border-gray-100 dark:border-dark-4">
                            @foreach($question->answers as $answer)
                                <div class="flex items-center space-x-3 p-3.5 rounded-xl {{ $answer->is_true ? 'bg-green-100 dark:bg-green-900/80' : 'bg-white dark:bg-dark-2' }} text-gray-700 dark:text-gray-200 border-2 {{ $answer->is_correct ? 'border-green-100 dark:border-green-800/30' : 'border-gray-100 dark:border-dark-4' }}">
                                    <span>{{ $answer->text }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
            
            <div class="mt-4">
                {{ $questions->links() }}
            </div>
        </div>
    </div>
</x-layout>
