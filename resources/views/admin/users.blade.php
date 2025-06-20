<x-admin.layout>
    <livewire:user-subscription-modal />
    <div class="bg-white dark:bg-dark-2 rounded-2xl shadow-lg p-8">
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
                            <livewire:admin-user-row :$user wire:key="user-{{ $user->id }}" />
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
