<x-admin.layout>
    <div class="bg-white dark:bg-dark-2 rounded-2xl shadow-lg p-8">
        @if(session('error'))
            <div class="mb-6 bg-red-50 dark:bg-red-500/10 border-l-4 border-red-500 p-4 rounded-lg">
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
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">რეგულაციის რედაქტირება</h2>
        </div>

        <form action="{{ route('admin.regulations.update', $regulation) }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')
            
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">რეგულაციის სახელი</label>
                <input type="text" name="name" id="name" value="{{ $regulation->name }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-dark-4 dark:bg-dark-2 dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200">აღწერა</label>
                <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-dark-4 dark:bg-dark-2 dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">{{ $regulation->description }}</textarea>
            </div>

            <div>
                <label for="link" class="block text-sm font-medium text-gray-700 dark:text-gray-200">ბმული</label>
                <input type="url" name="link" id="link" value="{{ $regulation->link }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-dark-4 dark:bg-dark-2 dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
            </div>

            <div>
                <label for="date_applied" class="block text-sm font-medium text-gray-700 dark:text-gray-200">ძალაში შესვლის თარიღი</label>
                <input type="date" name="date_applied" id="date_applied" value="{{ $regulation->date_applied }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-dark-4 dark:bg-dark-2 dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.regulations.regulations') }}" class="px-5 py-2.5 bg-gray-200 dark:bg-dark-3 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-dark-4 transition-colors duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    <span class="font-medium">გაუქმება</span>
                </a>
                <button type="submit" class="px-5 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span class="font-medium">შენახვა</span>
                </button>
            </div>
        </form>
    </div>

</x-admin.layout>
