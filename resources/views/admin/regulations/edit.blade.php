<x-admin.layout>
    <div class="bg-white dark:bg-dark-2 rounded-md shadow-lg overflow-hidden">
        <div class="p-6 sm:p-8 border-b border-gray-200 dark:border-dark-4">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">რეგულაციის ბმულის რედაქტირება</h2>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                შეცვლილი სახელი და ბმული ავტომატურად აისახება საჯარო რეგულაციების გვერდზე.
            </p>
        </div>

        <form action="{{ route('admin.regulations.update', $regulation) }}" method="POST" class="p-6 sm:p-8 space-y-6">
            @csrf
            @method('PATCH')

            @if($errors->any())
                <div class="rounded-md border border-red-200 dark:border-red-500/30 bg-red-50 dark:bg-red-500/10 p-4 text-red-700 dark:text-red-300">
                    გთხოვთ შეამოწმოთ შევსებული ველები.
                </div>
            @endif

            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                        დოკუმენტის სახელწოდება <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="name"
                           id="name"
                           value="{{ old('name', $regulation->name) }}"
                           required
                           class="mt-1 block w-full rounded-md border-gray-300 dark:border-dark-4 dark:bg-dark-3 dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-300">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="link" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                        დოკუმენტის ბმული <span class="text-red-500">*</span>
                    </label>
                    <input type="url"
                           name="link"
                           id="link"
                           value="{{ old('link', $regulation->link) }}"
                           required
                           placeholder="https://matsne.gov.ge/ka/document/view/..."
                           class="mt-1 block w-full rounded-md border-gray-300 dark:border-dark-4 dark:bg-dark-3 dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                    @error('link')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-300">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <a href="{{ route('admin.regulations.regulations') }}"
                   class="px-5 py-2.5 bg-gray-100 dark:bg-dark-3 text-gray-700 dark:text-gray-200 rounded-md hover:bg-gray-200 dark:hover:bg-dark-4 transition-colors duration-200">
                    გაუქმება
                </a>
                <button type="submit"
                        class="px-5 py-2.5 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-200 shadow-md shadow-blue-600/20">
                    შენახვა
                </button>
            </div>
        </form>
    </div>
</x-admin.layout>
