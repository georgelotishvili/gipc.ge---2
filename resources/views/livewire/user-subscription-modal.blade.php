<div>
    <div x-data="{ open: false, userId: null }" 
         x-on:open-modal.window="open = $event.detail.name === 'edit-user'; userId = $event.detail.data"
         x-on:close-modal.window="open = false"
         x-show="open" 
         class="fixed inset-0 z-50 overflow-y-auto" 
         style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="open" 
                 x-transition:enter="ease-out duration-300" 
                 x-transition:enter-start="opacity-0" 
                 x-transition:enter-end="opacity-100" 
                 x-transition:leave="ease-in duration-200" 
                 x-transition:leave-start="opacity-100" 
                 x-transition:leave-end="opacity-0" 
                 class="fixed inset-0 transition-opacity" 
                 aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
            <div x-show="open" 
                 x-transition:enter="ease-out duration-300" 
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                 x-transition:leave="ease-in duration-200" 
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                 class="inline-block align-bottom bg-white dark:bg-dark-2 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                
                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                                გამოწერის რედაქტირება
                            </h3>
                            
                            <div class="mt-4 space-y-4">
                                <div>
                                    <label for="is_active" class="block text-sm font-medium text-gray-700 dark:text-gray-300">სტატუსი</label>
                                    <select id="is_active" wire:model.live.defer="is_active" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-700 dark:bg-dark-3 dark:text-gray-200 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                        <option value="1">გამოწერილი</option>
                                        <option value="0">არ არის გამოწერილი</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">გამოწერის ტიპი</label>
                                    <select id="type" wire:model.live.defer="type" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-700 dark:bg-dark-3 dark:text-gray-200 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                        <option value="{{ \App\Enums\SubscriptionType::WEEKLY->value }}">ყოველკვირეული</option>
                                        <option value="{{ \App\Enums\SubscriptionType::MONTHLY->value }}">ყოველთვიური</option>
                                        <option value="{{ \App\Enums\SubscriptionType::YEARLY->value }}">წლიური</option>
                                        <option value="{{ \App\Enums\SubscriptionType::UNLIMITED->value }}">უსასრულო</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="starts_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300">დაწყების თარიღი</label>
                                    <input type="date" id="starts_at" wire:model.live.defer="starts_at" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-dark-3 dark:text-gray-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                
                                <div>
                                    <label for="ends_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300">დასრულების თარიღი</label>
                                    <input type="date" id="ends_at" wire:model.live.defer="ends_at" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-dark-3 dark:text-gray-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 dark:bg-dark-3 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button wire:click="save" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-dark-2 sm:ml-3 sm:w-auto sm:text-sm">
                        შენახვა
                    </button>
                    <button @click="open = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-dark-2 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-dark-1 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-dark-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        გაუქმება
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
