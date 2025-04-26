<div>
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg dark:bg-green-800/20 dark:border-green-700 dark:text-green-400">
            {{ session('message') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg dark:bg-red-800/20 dark:border-red-700 dark:text-red-400">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @foreach ($systemSettings as $key => $systemSetting)
        <livewire:admin-system-setting :systemSetting="$systemSetting" wire:key="system-setting-{{ $systemSetting->id }}" />
    @endforeach
    <!-- Add Parameter Section -->
    <div class="mt-6 bg-gray-50 dark:bg-dark-3/50 rounded-xl p-5">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">პარამეტრის დამატება</h3>
        
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">პარამეტრის სახელი</label>
                <input type="text" wire:model.live.defer="newParameterKey" class="w-full rounded-lg border-gray-300 dark:border-dark-4 dark:bg-dark-2 text-gray-700 dark:text-gray-300 focus:border-primary-500 focus:ring-primary-500" placeholder="შეიყვანეთ პარამეტრის სახელი">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">პარამეტრის მნიშვნელობა</label>
                <input type="text" wire:model.live.defer="newParameterValue" class="w-full rounded-lg border-gray-300 dark:border-dark-4 dark:bg-dark-2 text-gray-700 dark:text-gray-300 focus:border-primary-500 focus:ring-primary-500" placeholder="შეიყვანეთ პარამეტრის მნიშვნელობა">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">პარამეტრის მნიშვნელობა</label>
                <input type="text" wire:model.live.defer="newParameterDescription" class="w-full rounded-lg border-gray-300 dark:border-dark-4 dark:bg-dark-2 text-gray-700 dark:text-gray-300 focus:border-primary-500 focus:ring-primary-500" placeholder="შეიყვანეთ პარამეტრის მნიშვნელობა">
            </div>
        </div>
        
        <div class="mt-4 flex justify-end">
            <button 
                wire:click="addParameter"
                class="px-6 py-2.5 bg-gradient-to-r from-green-600 to-green-500 text-white rounded-xl hover:from-green-700 hover:to-green-600 transition-all duration-300 text-sm font-medium shadow-lg shadow-green-500/30 hover:shadow-green-500/50 hover:-translate-y-0.5 focus:ring-2 focus:ring-green-500/60 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-2">
                დამატება
            </button>
        </div>
    </div>
</div>
