<x-admin.layout>
    <div class="bg-white dark:bg-dark-2/50 backdrop-blur-xl rounded-md p-5 sm:p-6 transition-all duration-500 shadow-[0_2px_8px_rgb(0,0,0,0.08)] dark:border-dark-4/50">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">პარამეტრები</h2>
            <p class="text-gray-500 dark:text-gray-400">სისტემის პარამეტრების მართვა</p>
        </div>

        <div class="grid grid-cols-1 gap-6">
            <!-- Subscription Settings -->
            <div class="bg-gray-50 dark:bg-dark-3/50 rounded-md p-5">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">ყურადღება !!!</h3>
                <p class="text-gray-700 dark:text-gray-300 mb-2">გთხოვთ პასუხისმგებლობით მოეპყროთ თითოეული პარამეტრის შეცვლას, წაშლას და დამატებას.</p>
                <p class="text-gray-700 dark:text-gray-300">ამ პარამეტრებზეა დამოკიდებული პროგრამის გამართული მუშაობა.</p>
                
            </div>
            
            <!-- System Settings -->
            <livewire:admin-system-settings />
        </div>
    </div>
</x-admin.layout> 