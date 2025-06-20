<div class="hover:bg-gray-50 dark:hover:bg-dark-3/50 transition-colors duration-200">
    <div class="grid grid-cols-6 px-6 py-4 items-center">
        <div class="whitespace-nowrap text-sm font-medium text-gray-500 dark:text-gray-400 w-16">#{{ $user->id }}</div>
        <div class="whitespace-nowrap">
            <div class="flex items-center">
                <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-full bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30">
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
            @if($subscription)
                <span class="px-2 py-1 bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-400 rounded-full text-xs">
                    {{ $subscription->is_active ? 'გამოწერილი' : 'არ არის გამოწერილი' }}
                </span>
                <div class="mt-1 text-xs">
                    <div>დაწყება: {{ $subscription->starts_at ?? 'N/A' }}</div>
                    <div>დასრულება: {{ $subscription->ends_at ?? 'N/A' }}</div>
                    <div>ტიპი: {{ $user->activeSubscriptionName() }}</div>
                </div>
            @else
                <span class="px-2 py-1 bg-gray-100 text-gray-600 dark:bg-gray-700/30 dark:text-gray-400 rounded-full text-xs">
                    გამოწერა არ არსებობს
                </span>
            @endif
        </div>
        <div class="whitespace-nowrap text-right text-sm font-medium">
            <div class="flex justify-end gap-2">
                <button @click="$dispatch('open-modal', { name: 'edit-user', userId: {{ $user->id }} })" class="px-3 py-1.5 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-lg hover:from-blue-700 hover:to-blue-600 transition-all duration-200 text-xs font-medium shadow-sm hover:shadow-md">
                    რედაქტირება
                </button>
                <button
                    x-data="{}"
                    x-on:click="if (confirm('ნამდვილად გსურთ მომხმარებლის წაშლა?')) { $wire.deleteUser({{ $user->id }}) }"
                    class="px-3 py-1.5 bg-gradient-to-r from-red-600 to-red-500 text-white rounded-lg hover:from-red-700 hover:to-red-600 transition-all duration-200 text-xs font-medium shadow-sm hover:shadow-md">
                    წაშლა
                </button>
            </div>
        </div>
    </div>
</div>
