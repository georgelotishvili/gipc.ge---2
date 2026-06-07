<x-admin.layout>
    <div class="bg-white dark:bg-dark-2 rounded-md shadow-lg overflow-hidden">
        <div class="p-6 sm:p-8 border-b border-gray-200 dark:border-dark-4">
            @if(session('error'))
                <div class="mb-6 bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/30 p-4 rounded-md text-red-700 dark:text-red-300">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="mb-6 bg-green-50 dark:bg-green-500/10 border border-green-200 dark:border-green-500/30 p-4 rounded-md text-green-700 dark:text-green-300">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">სამშენებლო რეგულაციები</h2>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        აქ დამატებული ბმულები ავტომატურად გამოჩნდება საჯარო გვერდზე.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('admin.regulations.create') }}"
                       class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-200 shadow-md shadow-blue-600/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6"/>
                        </svg>
                        ბმულის დამატება
                    </a>
                </div>
            </div>
        </div>

        <div class="p-6 sm:p-8 space-y-4">
            @forelse($regulations as $regulation)
                <article class="rounded-md border border-gray-200 dark:border-dark-4 bg-gray-50 dark:bg-dark-3 p-5 transition-all duration-200 hover:shadow-[0_12px_32px_rgba(37,99,235,0.12)]">
                    <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-5">
                        <div class="min-w-0">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                {{ $regulation->name }}
                            </h3>

                            <div class="mt-3 text-sm text-gray-500 dark:text-gray-400">
                                <a href="{{ $regulation->link }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 break-all">
                                    {{ $regulation->link }}
                                </a>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 flex-shrink-0">
                            <a href="{{ route('admin.regulations.edit', $regulation) }}"
                               class="inline-flex h-10 w-10 items-center justify-center rounded-md bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white dark:bg-blue-500/10 dark:text-blue-300 dark:hover:bg-blue-600 transition-colors duration-200"
                               title="რედაქტირება">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>

                            <form action="{{ route('admin.regulations.destroy', $regulation) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('ნამდვილად გსურთ ამ ბმულის წაშლა?')"
                                        class="inline-flex h-10 w-10 items-center justify-center rounded-md bg-red-50 text-red-600 hover:bg-red-600 hover:text-white dark:bg-red-500/10 dark:text-red-300 dark:hover:bg-red-500 transition-colors duration-200"
                                        title="წაშლა">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </article>
            @empty
                <div class="text-center py-12 rounded-md border border-dashed border-gray-300 dark:border-dark-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">ბმულები ჯერ არ არის დამატებული</h3>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">პირველი რეგულაციის ბმული დაამატეთ ადმინის პანელიდან.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-admin.layout>
