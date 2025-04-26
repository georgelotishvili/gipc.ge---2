<x-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white dark:bg-gray-800/50 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700/50 backdrop-blur-sm p-6 mb-8">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">ვაკანსიის რედაქტირება</h1>
            
            @if ($errors->any())
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/30 text-red-800 dark:text-red-200 px-4 py-3 rounded-xl mb-6">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('employers.update', $employer) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PATCH')
                
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">კომპანიის სახელი</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $employer->name) }}" 
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 focus:border-transparent shadow-sm transition-all duration-200 text-gray-900 dark:text-white" required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="space-y-2">
                    <label for="position" class="block text-sm font-medium text-gray-700 dark:text-gray-300">პოზიცია</label>
                    <input type="text" name="position" id="position" value="{{ old('position', $employer->position) }}" 
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 focus:border-transparent shadow-sm transition-all duration-200 text-gray-900 dark:text-white" required>
                    @error('position')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="space-y-2">
                    <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ქალაქი</label>
                    <input type="text" name="city" id="city" value="{{ old('city', $employer->city) }}" 
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 focus:border-transparent shadow-sm transition-all duration-200 text-gray-900 dark:text-white">
                    @error('city')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="space-y-2">
                    <label for="worktime" class="block text-sm font-medium text-gray-700 dark:text-gray-300">სამუშაო დრო</label>
                    <select name="worktime" id="worktime" 
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 focus:border-transparent shadow-sm transition-all duration-200 text-gray-900 dark:text-white">
                        @foreach(\App\Enums\WorkTimeType::cases() as $workTimeType)
                            <option value="{{ $workTimeType->value }}" {{ old('worktime', $employer->worktime) == $workTimeType->value ? 'selected' : '' }}>
                                {{ $workTimeType->label() }}
                            </option>
                        @endforeach
                    </select>
                    @error('worktime')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="space-y-2">
                    <label for="salary" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ხელფასი</label>
                    <input type="number" step="0.01" name="salary" id="salary" value="{{ old('salary', $employer->salary) }}" 
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 focus:border-transparent shadow-sm transition-all duration-200 text-gray-900 dark:text-white" required>
                    @error('salary')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="space-y-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">სამუშაოს აღწერა</label>
                    <textarea name="description" id="description" rows="5" 
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 focus:border-transparent shadow-sm transition-all duration-200 text-gray-900 dark:text-white" required>{{ old('description', $employer->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="space-y-2">
                    <label for="skills" class="block text-sm font-medium text-gray-700 dark:text-gray-300">საჭირო უნარები (მძიმით გამოყოფილი)</label>
                    <input type="text" name="skills" id="skills" value="{{ old('skills', $employer->skills) }}" 
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 focus:border-transparent shadow-sm transition-all duration-200 text-gray-900 dark:text-white" required>
                    @error('skills')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">საკონტაქტო ინფორმაცია</label>
                    <div class="space-y-3">
                        <input type="email" name="email" id="email" placeholder="ელ-ფოსტა" value="{{ old('email', $employer->email) }}" 
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 focus:border-transparent shadow-sm transition-all duration-200 text-gray-900 dark:text-white" required>
                        
                        <input type="text" name="phone" id="phone" placeholder="ტელეფონი" value="{{ old('phone', $employer->phone) }}" 
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 focus:border-transparent shadow-sm transition-all duration-200 text-gray-900 dark:text-white" required>
                        
                        <input type="url" name="website" id="website" placeholder="ვებსაიტი (არასავალდებულო)" value="{{ old('website', $employer->website) }}" 
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 focus:border-transparent shadow-sm transition-all duration-200 text-gray-900 dark:text-white">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    @error('website')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="space-y-2">
                    <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">კომპანიის ლოგო (არასავალდებულო)</label>
                    @if($employer->image)
                        <div class="mb-3">
                            <img src="{{ $employer->image->url }}" alt="Current logo" class="h-20 w-auto object-contain rounded">
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">მიმდინარე ლოგო</p>
                        </div>
                    @endif
                    <input type="file" name="image" id="image" 
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 focus:border-transparent shadow-sm transition-all duration-200 text-gray-900 dark:text-white">
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex items-center justify-end gap-4 pt-4">
                    <a href="{{ route('jobs') }}" class="inline-flex items-center justify-center px-6 py-3 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-xl font-medium transition-all duration-200 shadow-sm hover:shadow-md">
                        გაუქმება
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-xl font-medium transition-all duration-200 shadow-md hover:shadow-lg">
                        განახლება
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>