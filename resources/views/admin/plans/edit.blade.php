<x-admin.layout>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 py-6">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white">ფასის რედაქტირება</h3>
                </div>
                <div class="p-6">
                    @if (session('error'))
                        <div
                            class="mb-4 p-4 rounded-lg bg-red-100 dark:bg-red-900/50 border border-red-200 dark:border-red-800">
                            <p class="text-red-700 dark:text-red-300">{{ session('error') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('admin.plans.update', $plan->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- Plans -->
                            <div>
                                <label for="plan_type_id"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    ტიპი
                                </label>
                                <select name="plan_type_id" id="plan_type_id"
                                    class="w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-dark-3 px-4 py-2 focus:border-primary-500 focus:ring-primary-500">
                                    <option disabled selected>აირჩიეთ ტიპი</option>
                                    @foreach ($planTypes as $planType)
                                        <option value="{{ $planType->id }}"
                                            {{ old('plan_type_id', $plan->plan_type_id) == $planType->id ? 'selected' : '' }}>
                                            {{ $planType->type_name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('plan_type_id')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Name -->
                            <div>
                                <label for="plan_name"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    სახელი
                                </label>
                                <input type="text" name="plan_name" id="plan_name" value="{{ $plan->plan_name }}"
                                    required
                                    class="w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-dark-3 px-4 py-2 focus:border-primary-500 focus:ring-primary-500">
                                @error('plan_name')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="plan_description"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    აღწერა
                                </label>
                                <input type="text" name="plan_description" id="plan_description"
                                    value="{{ $plan->plan_description }}" required
                                    class="w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-dark-3 px-4 py-2 focus:border-primary-500 focus:ring-primary-500">
                                @error('plan_description')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Price -->
                            <div>
                                <label for="plan_price"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    ფასი
                                </label>
                                <input type="number" name="plan_price" id="plan_price" value="{{ $plan->plan_price }}"
                                    required
                                    class="w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-dark-3 px-4 py-2 focus:border-primary-500 focus:ring-primary-500">
                                @error('plan_price')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Small Description -->
                            <div>
                                <label for="plan_discount"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    ფასდაკლება
                                </label>
                                <input type="number" name="plan_discount" id="plan_discount"
                                    value="{{ $plan->plan_discount }}"
                                    class="w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-dark-3 px-4 py-2 focus:border-primary-500 focus:ring-primary-500">
                                @error('plan_discount')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="plan_recommended"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    რეკომენდებული
                                </label>
                                <select name="plan_recommended" id="plan_recommended"
                                    class="w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-dark-3 px-4 py-2 focus:border-primary-500 focus:ring-primary-500">
                                    <option disabled
                                        {{ old('plan_recommended', $plan->plan_recommended) ? '' : 'selected' }}>იყოს
                                        რეკომენდებული?
                                    </option>
                                    <option value="1"
                                        {{ old('plan_recommended', $plan->plan_recommended) == '1' ? 'selected' : '' }}>
                                        დიახ</option>
                                    <option value="0"
                                        {{ old('plan_recommended', $plan->plan_recommended) == '0' ? 'selected' : '' }}>
                                        არა</option>
                                </select>
                                @error('plan_recommended')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="is_active"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    აქტიური
                                </label>
                                <select name="is_active" id="is_active"
                                    class="w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-dark-3 px-4 py-2 focus:border-primary-500 focus:ring-primary-500">
                                    <option disabled selected>აქტიური</option>
                                    <option value="1"
                                        {{ old('is_active', $plan->is_active) == '1' ? 'selected' : '' }}>დიახ
                                    </option>
                                    <option value="0"
                                        {{ old('is_active', $plan->is_active) == '0' ? 'selected' : '' }}>არა
                                    </option>
                                </select>
                                @error('is_active')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>



                            <div>
                                <label for="plan_order"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    რიგი
                                </label>
                                <input type="number" name="plan_order" id="plan_order" value="{{ $plan->plan_order }}"
                                    required
                                    class="text-black dark:text-white w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-dark-3 px-4 py-2 focus:border-primary-500 focus:ring-primary-500">
                                @error('plan_order')
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
