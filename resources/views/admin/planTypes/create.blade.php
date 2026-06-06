<x-admin.layout>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 py-6">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-md shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white">ტიპის დამატება</h3>
                </div>
                <div class="p-6">
                    @if(session('error'))
                        <div class="mb-4 p-4 rounded-md bg-red-100 dark:bg-red-900/50 border border-red-200 dark:border-red-800">
                            <p class="text-red-700 dark:text-red-300">{{ session('error') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('admin.plan-types.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Type Name -->
                            <div>
                                <label for="type_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    სახელი
                                </label>
                                <input type="text" 
                                       name="type_name" 
                                       id="type_name" 
                                       value="{{ old('type_name') }}"
                                       required placeholder="მაგ: 1 თვე"
                                       class="w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-dark-3 px-4 py-2 focus:border-primary-500 focus:ring-primary-500">
                                @error('type_name')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Type Duration -->
                            <div>
                                <label for="type_duration" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    ვადა (დღეებში)
                                </label>
                                <input type="number" 
                                       name="type_duration" 
                                       id="type_duration" 
                                       value="{{ old('type_duration') }}"
                                       required placeholder="მაგ: 7, 30, 365"
                                       class="w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-dark-3 px-4 py-2 focus:border-primary-500 focus:ring-primary-500">
                                @error('type_duration')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Is Free -->
                            <div>
                                <label for="is_free" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    უფასო
                                </label>
                                <select name="is_free" id="is_free" class="w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-dark-3 px-4 py-2 focus:border-primary-500 focus:ring-primary-500">
                                    <option selected disabled>უფასოა?</option>
                                    <option value="1" {{ old('is_free') == '1' ? 'selected' : '' }}>დიახ</option>
                                    <option value="0" {{ old('is_free') == '0' ? 'selected' : '' }}>არა</option>
                                </select>
                                @error('is_free')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>


                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="{{ route('admin.plans') }}" 
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