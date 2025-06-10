<x-admin.layout>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 py-6">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white">ფასის დამატება</h3>
                </div>
                <div class="p-6">
                    @if(session('error'))
                        <div
                            class="mb-4 p-4 rounded-lg bg-red-100 dark:bg-red-900/50 border border-red-200 dark:border-red-800">
                            <p class="text-red-700 dark:text-red-300">{{ session('error') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('admin.pricing.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- Plans -->
                            <div>
                                <label for="plan_id"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    სახეობა
                                </label>
                                <select name="plan_id" id="plan_id"
                                    class="w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-dark-3 px-4 py-2 focus:border-primary-500 focus:ring-primary-500">
                                    <option disabled selected>აირჩიეთ სახეობა</option>
                                    @foreach (App\Models\Plan::all() as $plan)
                                        <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                                    @endforeach
                                </select>
                                @error('plan_id')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Name -->
                            <div>
                                <label for="name"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    დასახელება
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                    placeholder="მაგ: 1 კვირა, 1 თვე"
                                    class="w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-dark-3 px-4 py-2 focus:border-primary-500 focus:ring-primary-500">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="price"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    ფასი
                                </label>
                                <input type="number" name="price" id="price" value="{{ old('price') }}" required
                                    placeholder="მაგ: 350"
                                    class="w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-dark-3 px-4 py-2 focus:border-primary-500 focus:ring-primary-500">
                                @error('price')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Expiry Date -->
                            <div>
                                <label for="term" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    ვადა
                                </label>
                                <input type="text" placeholder="1 კვირა" name="term" id="term" 
                                    value="{{ old('term') }}"
                                    class="w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-dark-3 px-4 py-2 focus:border-primary-500 focus:ring-primary-500">
                                @error('term')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Small Description -->
                            <div>
                                <label for="small_description"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    პატარა აღწერა
                                </label>
                                <input type="text" name="small_description" id="small_description"
                                    value="{{ old('small_description') }}"
                                    class="w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-dark-3 px-4 py-2 focus:border-primary-500 focus:ring-primary-500">
                                @error('small_description')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="featured"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    რეკომენდებული
                                </label>
                                <select name="featured" id="featured"
                                    class="w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-dark-3 px-4 py-2 focus:border-primary-500 focus:ring-primary-500">
                                    <option disabled selected>იყოს რეკომენდებული?</option>
                                    <option value="true">კი</option>
                                    <option value="false">არა</option>
                                </select>
                                @error('featured')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tags -->
                            <div x-data="{
                                tags: {{ json_encode(old('tags') ? explode(',', old('tags')) : []) }},
                                input: '',
                                addTag() {
                                    let parts = this.input.split(',');
                                    parts.forEach(part => {
                                        let tag = part.trim();
                                        if (tag.length > 0) {
                                            this.tags.push(tag);
                                        }
                                    });
                                    this.input = '';
                                },
                                removeTag(index) {
                                    this.tags.splice(index, 1);
                                },
                                onInput(e) {
                                    if (e.inputType === 'insertText' && e.data === ',') {
                                        let val = this.input.slice(0, -1).trim();
                                        if (val.length > 0) {
                                            this.tags.push(val);
                                        }
                                        this.input = '';
                                    }
                                }
                            }" x-init="$watch('tags', value => $refs.hiddenTags.value = tags.join(','))">
                                <label for="tags"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    თეგები
                                </label>
                                <div
                                    class="w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-dark-3 px-1 py-[2px] flex flex-wrap gap-2 focus-within:border-primary-500 focus-within:ring-primary-500">
                                    <template x-for="(tag, index) in tags" :key="index">
                                        <span
                                            class="inline-flex items-center px-2 border border-gray-500 bg-gray-100 text-gray-700 text-xs font-medium m-1 rounded-xl">
                                            <span x-text="tag"></span>
                                            <button type="button"
                                                class="ml-1 text-lg text-red-500 hover:text-red-500 focus:outline-none"
                                                @click="removeTag(index)">
                                                &times;
                                            </button>
                                        </span>
                                    </template>
                                    <input type="text" x-model="input"
                                        @keydown.enter.prevent="if(input.trim().length > 0) { tags.push(input.trim()); input = ''; }"
                                        @input="onInput($event)"
                                        class="flex-1 min-w-[120px] border-none focus:ring-0 bg-transparent text-sm"
                                        placeholder="მაგ: დამატებითი მასალები, პერსონალური მენტორი">
                                </div>
                                <input type="hidden" name="tags" x-ref="hiddenTags" :value="tags . join(',')" required>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    თეგები გამოყოფილი მძიმით (,) თითოეული თეგისთვის. მაგ: დამატებითი მასალები,
                                    პერსონალური მენტორი
                                </p>
                                @error('tags')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="{{ route('admin.pricing') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 active:bg-gray-400 dark:active:bg-gray-500 focus:outline-none focus:border-gray-400 dark:focus:border-gray-600 focus:ring focus:ring-gray-200 dark:focus:ring-gray-700 disabled:opacity-25 transition">
                                დაბრუნება
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-800 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                                შექმნა
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin.layout>