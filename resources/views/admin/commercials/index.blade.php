<x-admin.layout>
<div class="min-h-screen py-6">
    <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 rounded-md shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white">რეკლამები</h3>
                <a href="{{ route('admin.commercials.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-800 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    ახალი რეკლამის დამატება
                </a>
            </div>
            <div class="p-6">
                @if(session('success'))
                    <div class="mb-4 p-4 rounded-md bg-green-100 dark:bg-green-900/50 border border-green-200 dark:border-green-800">
                        <p class="text-green-700 dark:text-green-300">{{ session('success') }}</p>
                    </div>
                @endif

                <div class="overflow-x-auto w-full">
                    <table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="w-2/5 px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ფოტო</th>
                                <th scope="col" class="w-1/5 px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ატვირთვის თარიღი</th>
                                <th scope="col" class="w-1/5 px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ვადის დასრულება</th>
                                <th scope="col" class="w-1/5 px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">რედაქტირება</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($commercials as $commercial)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                    <td class="px-6 py-4">
                                        @if($commercial->image_link)
                                            <img src="{{ $commercial->getImageLinkAttribute() }}" alt="{{ $commercial->name }}" class="h-28 w-56 object-cover rounded-md border border-gray-200 dark:border-gray-700">
                                        @else
                                            <span class="text-gray-500 dark:text-gray-400">სურათი არ არის</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $commercial->created_at ? $commercial->created_at->format('d.m.Y H:i') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                                        {{ $commercial->expiration_date ? $commercial->expiration_date->format('d.m.Y H:i') : 'ვადა არ არის' }}
                                    </td>
                                    <td class="px-6 py-4 text-right text-sm font-medium">
                                        <a href="{{ route('admin.commercials.edit', $commercial) }}" class="inline-flex items-center px-3 py-1.5 bg-indigo-600 border border-transparent rounded-md font-medium text-xs text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            რედაქტირება
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 text-center">
                                        რეკლამები არ მოიძებნა.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $commercials->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
</x-admin.layout>
