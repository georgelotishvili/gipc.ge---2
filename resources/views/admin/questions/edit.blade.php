<x-admin.layout>
    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg p-8">
        <div class="mb-8 border-b pb-4">
            <h2 class="text-2xl font-bold text-gray-800">კითხვის რედაქტირება</h2>
            <p class="text-gray-600 mt-1">ID: #{{$question->id}}</p>
        </div>

        <form action="{{ route('admin.questions.update', $question->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')
            
            <!-- Question Text -->
            <div>
                <label for="text" class="block text-sm font-medium text-gray-700 mb-2">კითხვის ტექსტი</label>
                <textarea id="text" name="text" rows="3" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary transition duration-200">{{$question->text}}</textarea>
            </div>

            <!-- Group Section -->
            <div>
                <label for="group" class="block text-sm font-medium text-gray-700 mb-2">ჯგუფი</label>
                <select id="group" name="group" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary transition duration-200">
                    @foreach($groups as $group)
                        <option value="{{$group->id}}" {{ $question->groups->contains($group->id) ? 'selected class=bg-blue-100' : '' }}>
                            {{$group->title}}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Answers Section -->
            <div class="space-y-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">პასუხები</label>
                
                @foreach($question->answers as $index => $answer)
                <div class="flex items-center space-x-4 p-4 border rounded-lg hover:border-primary transition duration-200">
                    <div class="flex-1">
                        <input type="text" name="answers[{{$index}}][text]" value="{{$answer->text}}" 
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary transition duration-200">
                    </div>
                    <div class="flex items-center space-x-3">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="radio" name="correct_answer" value="{{$index}}" 
                                   {{$answer->is_true ? 'checked' : ''}}
                                   class="text-primary focus:ring-primary h-4 w-4 transition duration-200">
                            <span class="text-sm text-gray-600">სწორი პასუხი</span>
                        </label>
                        <button type="button" class="p-2 text-red-600 hover:text-red-900 rounded-full hover:bg-red-50 transition duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
                @endforeach

                <button type="button" class="w-full py-3 border-2 border-dashed border-gray-300 rounded-lg text-gray-600 hover:border-primary hover:text-primary transition duration-200">
                    + პასუხის დამატება
                </button>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 pt-6 border-t">
                <a href="{{ route('admin.questions') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                    გაუქმება
                </a>
                <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition duration-200">
                    შენახვა
                </button>
            </div>
        </form>
    </div>
</x-admin.layout>