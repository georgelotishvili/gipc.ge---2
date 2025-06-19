<x-admin.layout>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 py-6">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white">პარამეტრის რედაქტირება</h3>
                </div>
                <div class="p-6">
                    @if(session('success-plan-option'))
                        <div
                            class="mb-4 p-4 rounded-lg bg-green-100 dark:bg-green-900/50 border border-green-200 dark:border-green-800">
                            <p class="text-green-700 dark:text-green-300">{{ session('success-plan-option') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('admin.plan-options.update', $planOption->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- Plan id -->
                            <div>
                                <label for="plan_id"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    ფასის პარამეტრი
                                </label>
                                <select name="plan_id" id="plan_id"
                                    class="w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-dark-3 px-4 py-2 focus:border-primary-500 focus:ring-primary-500">
                                    <option disabled selected>აირჩიეთ ფასი</option>
                                    @foreach (App\Models\Plan::all() as $plan)
                                        <option value="{{ $plan->id }}" {{ $planOption->plan_id == $plan->id ? 'selected' : '' }}>{{ $plan->plan_name }}</option>
                                    @endforeach
                                </select>
                                @error('plan_id')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>


                            <!-- Option Description -->
                            <div>
                                <label for="option_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    აღწერა
                                </label>
                                <input type="text" 
                                       name="option_description" 
                                       id="option_description" 
                                       value="{{ $planOption->option_description }}"
                                       required placeholder="მაგ: უფასო კონსულტაცია"
                                       class="w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-dark-3 px-4 py-2 focus:border-primary-500 focus:ring-primary-500">
                                @error('option_description')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                             <!-- Is Included -->
                             <div>
                                <label for="is_included" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    გამოჩნდება
                                </label>
                                <select name="is_included" id="is_included"
                                    class="w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-dark-3 px-4 py-2 focus:border-primary-500 focus:ring-primary-500">
                                    <option disabled {{ $planOption->is_included == null ? 'selected' : '' }}>აირჩიეთ გამოჩნდება</option>
                                    <option value="1" {{ $planOption->is_included == 1 ? 'selected' : '' }}>დიახ</option>
                                    <option value="0" {{ $planOption->is_included == 0 ? 'selected' : '' }}>არა</option>
                                </select>
                                @error('is_included')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Is Active -->
                            <div>
                                <label for="is_active" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    სტატუსი
                                </label>
                                <select name="is_active" id="is_active"
                                    class="w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-dark-3 px-4 py-2 focus:border-primary-500 focus:ring-primary-500">
                                    <option disabled {{ $planOption->is_active == null ? 'selected' : '' }}>აირჩიეთ სტატუსი</option>
                                    <option value="1" {{ $planOption->is_active == 1 ? 'selected' : '' }}>აქტიური</option>
                                    <option value="0" {{ $planOption->is_active == 0 ? 'selected' : '' }}>გათიშული</option>
                                </select>
                                @error('is_active')
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
                                განახლება
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin.layout>