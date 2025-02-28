<x-admin.layout>
    <div class="space-y-6 max-md:max-w-lg max-md:mx-auto">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 lg:gap-6">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">კითხვები</h2>
            <div class="flex flex-col md:flex-row items-start md:items-center md:justify-between lg:justify-normal gap-3 md:gap-6 w-full lg:w-auto order-last lg:order-none">
                <div class="relative inline-block text-left w-full md:w-auto my-2">
                    <a href="{{route('admin.questions.create')}}" class="px-4 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors duration-200">
                        დამატება
                    </a>
                </div>
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
                                        <a href="{{ route('admin.questions', ['g' => $group->name]) }}" 
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
                    <div class="flex gap-2">
                        <button id="deleteButton" onclick="toggleDeleteMode()" class="w-full md:w-auto px-4 py-2.5 bg-red-600 text-white rounded-xl hover:shadow-lg transition-all duration-300">
                            არჩეულის წაშლა
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <form id="deleteForm" action="{{route('admin.questions.destroy', 'bulk')}}" method="POST">
            @method('DELETE')
            @csrf
            <div class="space-y-4">
                @foreach($questions as $question)
                    <div class="relative group bg-white dark:bg-dark-2 rounded-2xl border-2 border-gray-100 dark:border-dark-4 overflow-hidden transition-all duration-300 hover:shadow-[0_15px_30px_-15px_rgba(0,0,0,0.1)] dark:hover:shadow-[0_15px_30px_-15px_rgba(0,0,0,0.3)] hover:border-primary/30 dark:hover:border-primary/30">
                        <div class="p-4 flex flex-col md:flex-row justify-between items-start md:items-center space-y-2 md:space-y-0 md:space-x-4">
                            <div class="flex items-center">
                                <input type="checkbox" 
                                    name="selected_questions[]" 
                                    value="{{$question->id}}" 
                                    class="checkbox-delete hidden w-5 h-5 mr-2 rounded-md border-2 border-gray-300 text-primary focus:ring-2 focus:ring-primary/20 focus:ring-offset-0 cursor-pointer transition-all duration-200 hover:border-primary/60">
                                <div class="flex flex-col md:flex-row items-start md:items-center w-full md:w-auto space-y-2 md:space-y-0 md:space-x-6">
                                    <div class="flex justify-between w-full md:w-auto items-center space-x-4">
                                        <span class="text-gray-400 dark:text-gray-500 text-sm font-medium">#{{$question->id}}</span>
                                        <span class="px-3 py-1.5 text-xs font-medium rounded-xl bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border-2 border-indigo-100/50 dark:border-indigo-500/20">
                                            @foreach($question->groups as $group) {{$group->name}} @endforeach
                                        </span>
                                    </div>
                                    <p class="mt-2 md:mt-0 text-gray-900 dark:text-gray-100 cursor-pointer hover:text-primary dark:hover:text-primary transition-colors duration-300 md:flex-grow" 
                                        onclick="document.getElementById('answers-{{$question->id}}').classList.toggle('hidden')">
                                        {{$question->text}}
                                    </p>
                                </div>
                            </div>
                            <div class="flex justify-end mt-3 md:mt-0 space-x-2">
                                <a href="{{route('admin.questions.edit', $question->id)}}" 
                                    class="p-2.5 text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 rounded-xl hover:bg-indigo-50 dark:hover:bg-indigo-500/10 transition-all duration-300 hover:-translate-y-0.5">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{route('admin.questions.destroy', $question->id)}}" method="POST" class="inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" 
                                            class="p-2.5 text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 rounded-xl hover:bg-red-50 dark:hover:bg-red-500/10 transition-all duration-300 hover:-translate-y-0.5">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div id="answers-{{$question->id}}" class="hidden">
                            <div class="p-4 bg-gray-50 dark:bg-dark-3 space-y-2.5 border-t-2 border-gray-100 dark:border-dark-4">
                                @foreach($question->answers as $answer)
                                    <div class="flex items-center space-x-3 p-3.5 rounded-xl {{ $answer->is_true ? 'bg-gradient-to-r from-emerald-600 via-emerald-500 to-emerald-600 text-white shadow-lg shadow-emerald-500/20 dark:shadow-emerald-500-' : 'bg-white dark:bg-dark-2 text-gray-700 dark:text-gray-200 border-2 border-gray-100 dark:border-dark-4' }}">
                                        @if($answer->is_true)
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        @endif
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
        </form>
    </div>

    <script>
        let deleteMode = false;
        
        function toggleDeleteMode() {
            deleteMode = !deleteMode;
            const checkboxes = document.querySelectorAll('.checkbox-delete');
            const deleteButton = document.getElementById('deleteButton');
            
            checkboxes.forEach(checkbox => {
                checkbox.classList.toggle('hidden');
            });
            
            if (deleteMode) {
                deleteButton.textContent = 'წაშლა';
                deleteButton.onclick = submitDelete;
            } else {
                deleteButton.textContent = 'რამდენიმეს წაშლა';
                deleteButton.onclick = toggleDeleteMode;
            }
        }

        function submitDelete() {
            const selectedQuestions = document.querySelectorAll('.checkbox-delete:checked');
            if (selectedQuestions.length > 0) {
                if (confirm('ნამდვილად გსურთ არჩეული კითხვების წაშლა?')) {
                    document.getElementById('deleteForm').submit();
                }
            } else {
                alert('გთხოვთ აირჩიოთ მინიმუმ ერთი კითხვა');
            }
        }
    </script>
</x-admin.layout>
