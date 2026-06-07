<x-layout>
    <section class="py-10 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    სამშენებლო რეგულაციები
                </h1>
                <p class="text-base sm:text-lg text-gray-600 dark:text-gray-300 max-w-4xl mx-auto">
                    აქ განთავსებულია ოფიციალური სამართლებრივი დოკუმენტების ბმულები.
                </p>
            </div>

            <div class="space-y-4">
                @forelse($regulations as $regulation)
                    <article class="group w-full rounded-md border border-slate-300/80 dark:border-slate-700/80 bg-white dark:bg-dark-2 shadow-[0_12px_32px_rgba(37,99,235,0.12)] hover:shadow-[0_16px_42px_rgba(37,99,235,0.18)] transition-all duration-300 overflow-hidden">
                        <div class="p-5 sm:p-6 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
                            <div class="flex gap-4 min-w-0">
                                <div class="h-11 w-11 rounded-md bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-300 flex items-center justify-center flex-shrink-0">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 6H5.75A2.75 2.75 0 003 8.75v8.5A2.75 2.75 0 005.75 20h8.5A2.75 2.75 0 0017 17.25V11.5M8 16L20 4m0 0h-5.5M20 4v5.5" />
                                    </svg>
                                </div>

                                <div class="min-w-0">
                                    <h2 class="text-xl sm:text-2xl font-semibold text-gray-950 dark:text-white leading-snug">
                                        {{ $regulation->name }}
                                    </h2>

                                    <p class="mt-2 text-gray-600 dark:text-gray-300 leading-relaxed">
                                        დოკუმენტის სანახავად გახსენით ოფიციალური ბმული.
                                    </p>
                                </div>
                            </div>

                            <a href="{{ $regulation->link }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="inline-flex items-center justify-center gap-2 rounded-md bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-md shadow-blue-600/20 hover:bg-blue-700 hover:shadow-lg hover:shadow-blue-600/25 transition-all duration-300 flex-shrink-0">
                                დოკუმენტის ნახვა
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 6H5.75A2.75 2.75 0 003 8.75v8.5A2.75 2.75 0 005.75 20h8.5A2.75 2.75 0 0017 17.25V11.5M8 16L20 4m0 0h-5.5M20 4v5.5" />
                                </svg>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="text-center py-14 rounded-md border border-slate-300/80 dark:border-slate-700/80 bg-white dark:bg-dark-2 shadow-[0_12px_32px_rgba(37,99,235,0.12)]">
                        <div class="h-14 w-14 rounded-md bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-300 flex items-center justify-center mx-auto mb-4">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                            რეგულაციები ჯერ არ არის დამატებული
                        </h2>
                        <p class="text-gray-500 dark:text-gray-400">
                            დამატებული ბმულები აქ ავტომატურად გამოჩნდება.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</x-layout>
