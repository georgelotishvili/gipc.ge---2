<x-admin.layout>
    <div class="bg-white rounded-2xl shadow-lg p-8">
        <div class="flex justify-between items-center mb-6 gap-6">
            <h2 class="text-2xl font-bold text-gray-800">კითხვები</h2>
            <div class="relative inline-block text-left">
                <button onclick="document.getElementById('filter-dropdown').classList.toggle('hidden')" 
                    class="px-4 py-2.5 bg-white border border-gray-200 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200 flex items-center gap-3 shadow-sm">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    <span class="font-medium">ფილტრი</span>
                </button>
                <div id="filter-dropdown" class="hidden absolute right-0 mt-2 w-64 rounded-xl shadow-lg bg-white ring-1 ring-black ring-opacity-5 border border-gray-100 overflow-hidden">
                    <div class="py-2">
                        <div class="px-4 py-2 bg-gray-50 border-b border-gray-100">
                            <span class="text-sm font-semibold text-gray-600">აირჩიეთ ჯგუფი</span>
                        </div>
                        @foreach ($groups as $group)
                            <a href="{{ route('admin.questions', ['g' => $group->name]) }}" 
                                class="px-4 py-2.5 text-sm {{ request('g') == $group->name ? 'bg-blue-500 text-white hover:bg-blue-600' : 'text-gray-700 hover:bg-gray-50' }} transition-colors duration-150 flex items-center justify-between group">
                                <span>{{$group->title}}</span>
                                <svg class="w-4 h-4 {{ request('g') == $group->name ? 'text-white' : 'text-gray-400 opacity-0 group-hover:opacity-100' }} transition-opacity duration-150" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <livewire:question-search />
            <a href="{{route('admin.questions.create')}}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors duration-200">
                კითხვის დამატება
            </a>
        </div>

        <div class="space-y-4">
            @foreach($questions as $question)
                <div class="border rounded-lg overflow-hidden">
                    <div class="flex items-center justify-between p-4 bg-white hover:bg-gray-50 cursor-pointer" 
                         onclick="document.getElementById('answers-{{$question->id}}').classList.toggle('hidden')">
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-500 text-sm">#{{$question->id}}</span>
                            <span class="text-gray-500 text-sm">@foreach($question->groups as $group) {{$group->name}} @endforeach</span>
                            <p class="text-gray-900">{{$question->text}}</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <a href="{{route('admin.questions.edit', $question->id)}}" class="p-2 text-indigo-600 hover:text-indigo-900 rounded-full hover:bg-indigo-50">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <a href="{{route('admin.questions.destroy', $question->id)}}" class="p-2 text-red-600 hover:text-red-900 rounded-full hover:bg-red-50">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div id="answers-{{$question->id}}" class="hidden">
                        <div class="p-4 bg-gray-50 space-y-2">
                            @foreach($question->answers as $answer)
                                <div class="flex items-center space-x-3 p-2 rounded {{ $answer->is_true ? 'bg-green-700 text-white' : 'bg-white text-gray-700' }}">
                                    @if($answer->is_true)
                                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
    </div>
</x-admin.layout>
