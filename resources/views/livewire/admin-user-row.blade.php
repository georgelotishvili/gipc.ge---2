<div class="hover:bg-gray-50 dark:hover:bg-dark-3/50 transition-colors duration-200">
    <!-- Debug info -->
    <div class="px-6 py-2 bg-yellow-100 dark:bg-yellow-900/20 text-xs text-yellow-800 dark:text-yellow-200">
        Livewire Component ID: {{ $this->getId() }} | User ID: {{ $user->id }} | Test Counter: {{ $testCounter }} | Time: {{ now() }}
    </div>
    
    <!-- Session Messages -->
    @if(session('simple_test'))
        <div class="px-6 py-2 bg-green-100 dark:bg-green-900/20 text-xs text-green-800 dark:text-green-200">
            {{ session('simple_test') }}
        </div>
    @endif
    
    @if(session('test_message'))
        <div class="px-6 py-2 bg-blue-100 dark:bg-blue-900/20 text-xs text-blue-800 dark:text-blue-200">
            {{ session('test_message') }}
        </div>
    @endif
    
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
                    wire:click="confirmDelete"
                    class="px-3 py-1.5 bg-gradient-to-r from-red-600 to-red-500 text-white rounded-lg hover:from-red-700 hover:to-red-600 transition-all duration-200 text-xs font-medium shadow-sm hover:shadow-md">
                    წაშლა
                </button>
                <!-- Temporary test button -->
                <button
                    wire:click="testDelete"
                    class="px-3 py-1.5 bg-gradient-to-r from-yellow-600 to-yellow-500 text-white rounded-lg hover:from-yellow-700 hover:to-yellow-600 transition-all duration-200 text-xs font-medium shadow-sm hover:shadow-md">
                    Test
                </button>
                <!-- Simple increment test -->
                <button
                    wire:click="incrementTest"
                    class="px-3 py-1.5 bg-gradient-to-r from-purple-600 to-purple-500 text-white rounded-lg hover:from-purple-700 hover:to-purple-500 transition-all duration-200 text-xs font-medium shadow-sm hover:shadow-md">
                    +1
                </button>
                <!-- Simple test -->
                <button
                    wire:click="simpleTest"
                    class="px-3 py-1.5 bg-gradient-to-r from-green-600 to-green-500 text-white rounded-lg hover:from-green-700 hover:to-green-500 transition-all duration-200 text-xs font-medium shadow-sm hover:shadow-md">
                    Test
                </button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    @if($showDeleteModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                <!-- Modal panel -->
                <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900/30 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white" id="modal-title">
                                    Confirm User Deletion
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        This action cannot be undone. This will permanently delete the user account for <strong class="text-gray-900 dark:text-white">{{ $user->email }}</strong> and all associated data.
                                    </p>
                                    <div class="mt-4">
                                        <label for="deleteConfirmText" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Type the email address to confirm: <strong>{{ $user->email }}</strong>
                                        </label>
                                        <input 
                                            type="text" 
                                            id="deleteConfirmText"
                                            wire:model="deleteConfirmText"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-red-500 focus:border-red-500 dark:focus:ring-red-400 dark:focus:border-red-400"
                                            placeholder="Enter email address to confirm"
                                        >
                                        @error('deleteConfirmText') 
                                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    @error('delete') 
                                        <div class="mt-3 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-md">
                                            <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button 
                            type="button" 
                            wire:click="deleteUser"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-200"
                        >
                            Delete User
                        </button>
                        <button 
                            type="button" 
                            wire:click="cancelDelete"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-600 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-700 sm:mt-3 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-200"
                        >
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
