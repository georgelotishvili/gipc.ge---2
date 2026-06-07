<x-admin.layout>
    <div class="min-h-screen bg-gray-100 py-6 dark:bg-gray-900">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-md bg-white shadow-sm dark:bg-gray-800">
                <div class="border-b border-gray-200 p-6 dark:border-gray-700">
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white">რეკლამის რედაქტირება</h3>
                </div>

                <div class="p-6">
                    @if(session('error'))
                        <div class="mb-5 rounded-md border border-red-200 bg-red-100 p-4 dark:border-red-800 dark:bg-red-900/50">
                            <p class="text-red-700 dark:text-red-300">{{ session('error') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('admin.commercials.update', $commercial) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <div>
                            <span class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                მიმდინარე ფოტო
                            </span>
                            @if($commercial->image_link)
                                <img
                                    src="{{ $commercial->image_link }}"
                                    alt="რეკლამის ფოტო"
                                    class="h-48 w-full rounded-md border border-gray-200 object-cover dark:border-gray-700"
                                >
                            @else
                                <div class="flex h-48 items-center justify-center rounded-md border border-dashed border-gray-300 text-gray-500 dark:border-gray-700 dark:text-gray-400">
                                    ფოტო არ არის
                                </div>
                            @endif
                        </div>

                        <div>
                            <label for="image" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                ახალი ფოტო
                            </label>
                            <input
                                type="file"
                                name="image"
                                id="image"
                                accept="image/jpeg,image/png,image/gif"
                                class="w-full rounded-md border border-gray-300 px-4 py-2 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-700 dark:bg-dark-3"
                            >
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                თუ ფოტოს არ აირჩევთ, მიმდინარე ფოტო დარჩება.
                            </p>
                            @error('image')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="expiration_date" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                ვადის დასრულება
                            </label>
                            <input
                                type="datetime-local"
                                name="expiration_date"
                                id="expiration_date"
                                value="{{ old('expiration_date', $commercial->expiration_date ? $commercial->expiration_date->format('Y-m-d\TH:i') : '') }}"
                                class="w-full rounded-md border border-gray-300 px-4 py-2 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-700 dark:bg-dark-3"
                            >
                            @error('expiration_date')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end gap-3">
                            <a href="{{ route('admin.commercials') }}"
                               class="inline-flex items-center rounded-md border border-transparent bg-gray-200 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-800 transition hover:bg-gray-300 focus:border-gray-400 focus:outline-none focus:ring focus:ring-gray-200 active:bg-gray-400 disabled:opacity-25 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 dark:focus:border-gray-600 dark:focus:ring-gray-700 dark:active:bg-gray-500">
                                დაბრუნება
                            </a>
                            <button
                                type="submit"
                                class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition hover:bg-blue-700 focus:border-blue-800 focus:outline-none focus:ring focus:ring-blue-200 active:bg-blue-800 disabled:opacity-25">
                                განახლება
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin.layout>
