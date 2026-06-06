<x-admin.layout>
    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="mb-6 bg-green-50 dark:bg-green-900/20 border-l-4 border-green-500 p-4 rounded-md">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700 dark:text-green-300">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 p-4 rounded-md">
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
    
    <div class="bg-white dark:bg-dark-2 rounded-md shadow-lg p-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">მომხმარებლები</h2>
        </div>

        <div class="overflow-hidden">
            <div class="w-full overflow-x-auto">
                <div class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <div class="bg-gray-50 dark:bg-dark-3">
                        <div class="grid grid-cols-6 px-6 py-3">
                            <div class="text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider w-16">ID</div>
                            <div class="text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">მომხმარებელი</div>
                            <div class="text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">ელ-ფოსტა</div>
                            <div class="text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">რეგისტრაციის თარიღი</div>
                            <div class="text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">გამოწერები</div>
                            <div class="text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">მოქმედებები</div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-dark-2 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($users as $user)
                            <div class="hover:bg-gray-50 dark:hover:bg-dark-3/50 transition-colors duration-200">
                                <div class="grid grid-cols-6 px-6 py-4 items-center">
                                    <div class="whitespace-nowrap text-sm font-medium text-gray-500 dark:text-gray-400 w-16">#{{ $user->id }}</div>
                                    <div class="whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-md bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30">
                                                <span class="text-lg font-bold text-blue-500 dark:text-blue-400">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->name }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">{{ $user->email }}</div>
                                    <div class="whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $user->created_at ? $user->created_at->format('d.m.Y') : 'N/A' }}
                                    </div>
                                    <div class="whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        @if($user->subscription)
                                            <span class="px-2 py-1 bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-400 rounded-md text-xs">
                                                {{ $user->subscription->is_active ? 'გამოწერილი' : 'არ არის გამოწერილი' }}
                                            </span>
                                            <div class="mt-1 text-xs">
                                                <div>დაწყება: {{ $user->subscription->starts_at ?? 'N/A' }}</div>
                                                <div>დასრულება: {{ $user->subscription->ends_at ?? 'N/A' }}</div>
                                                <div>ტიპი: {{ $user->activeSubscriptionName() }}</div>
                                            </div>
                                        @else
                                            <span class="px-2 py-1 bg-gray-100 text-gray-600 dark:bg-gray-700/30 dark:text-gray-400 rounded-md text-xs">
                                                გამოწერა არ არსებობს
                                            </span>
                                        @endif
                                    </div>
                                    <div class="whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('admin.subscription.edit', $user->id) }}" class="px-3 py-1.5 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-md hover:from-blue-700 hover:to-blue-600 transition-all duration-200 text-xs font-medium shadow-sm hover:shadow-md">
                                                რედაქტირება
                                            </a>
                                            
                                            <!-- Delete Button with Confirmation -->
                                            <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('ნამდვილად გსურთ მომხმარებლის წაშლა? ეს ქმედება შეუქცევადია!')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1.5 bg-gradient-to-r from-red-600 to-red-500 text-white rounded-md hover:from-red-700 hover:to-red-600 transition-all duration-200 text-xs font-medium shadow-sm hover:shadow-md">
                                                    წაშლა
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8">
            {{ $users->links() }}
        </div>
    </div>
</x-admin.layout>
