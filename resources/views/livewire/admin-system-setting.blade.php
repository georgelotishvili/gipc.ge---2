<div class="bg-gray-50 dark:bg-dark-3/50 rounded-xl p-5 my-4">
    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">სისტემის პარამეტრები</h3>
    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">პარამეტრის სახელი</label>
            <input wire:model.live.defer="key" type="text" class="w-full rounded-lg border-gray-300 dark:border-dark-4 dark:bg-dark-2 text-gray-700 dark:text-gray-300 focus:border-primary-500 focus:ring-primary-500" value="ABECert">
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">პარამეტრი</label>
            <input wire:model.live.defer="value" type="text" class="w-full rounded-lg border-gray-300 dark:border-dark-4 dark:bg-dark-2 text-gray-700 dark:text-gray-300 focus:border-primary-500 focus:ring-primary-500" value="info@abecert.ge">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">აღწერა</label>
            <div class="p-3 bg-white dark:bg-dark-2 border border-gray-200 dark:border-dark-4 rounded-lg text-gray-700 dark:text-gray-300">
                {{ $systemSetting->description }}
            </div>
        </div>
    </div>
    <div class="mt-6 flex justify-end space-x-3">
        <button wire:click="$parent.deleteParameter({{ $systemSetting->id }})"
            onclick="confirm('ნამდვილად გსურთ წაშლა?') || event.stopImmediatePropagation()" 
            class="px-6 py-2.5 bg-gradient-to-r from-red-600 to-red-500 text-white rounded-xl hover:from-red-700 hover:to-red-600 transition-all duration-300 text-sm font-medium shadow-lg shadow-red-500/30 hover:shadow-red-500/50 hover:-translate-y-0.5 focus:ring-2 focus:ring-red-500/60 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-2">
            წაშლა
        </button>
        <button wire:click="saveParameter()" class="px-6 py-2.5 bg-gradient-to-r from-primary-600 to-primary-500 text-white rounded-xl hover:from-primary-700 hover:to-primary-600 transition-all duration-300 text-sm font-medium shadow-lg shadow-primary-500/30 hover:shadow-primary-500/50 hover:-translate-y-0.5 focus:ring-2 focus:ring-primary-500/60 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-2">
            შენახვა
        </button>
    </div>
</div>