<x-admin.layout>
    <div class="bg-white dark:bg-dark-2 rounded-md shadow-lg p-8">
        @if(session('error'))
            <div class="mb-6 bg-red-50 dark:bg-red-500/10 border-l-4 border-red-500 p-4 rounded-md">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700 dark:text-red-300">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">რეგულაციის დამატება</h2>
        </div>

        <form action="{{ route('admin.regulations.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">რეგულაციის სახელი</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 dark:border-dark-4 dark:bg-dark-2 dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200">აღწერა</label>
                <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-dark-4 dark:bg-dark-2 dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm"></textarea>
            </div>

            <div>
                <label for="link" class="block text-sm font-medium text-gray-700 dark:text-gray-200">ბმული</label>
                <input type="url" name="link" id="link" class="mt-1 block w-full rounded-md border-gray-300 dark:border-dark-4 dark:bg-dark-2 dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
            </div>

            <div>
                <label for="date_applied" class="block text-sm font-medium text-gray-700 dark:text-gray-200">ძალაში შესვლის თარიღი</label>
                <input type="date" name="date_applied" id="date_applied" class="mt-1 block w-full rounded-md border-gray-300 dark:border-dark-4 dark:bg-dark-2 dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.regulations.regulations') }}" class="px-4 py-2 bg-gray-100 dark:bg-dark-3 text-gray-700 dark:text-gray-200 rounded-md hover:bg-gray-200 dark:hover:bg-dark-4 transition-colors duration-200">
                    გაუქმება
                </a>
                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary/90 transition-colors duration-200">
                    დამატება
                </button>
            </div>
        </form>
    </div>

</x-admin.layout>
