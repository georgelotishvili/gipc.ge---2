<x-layout>
    @if(session('error'))
        <div class="mx-auto mt-6 max-w-3xl rounded-md border border-red-200 bg-red-50 p-4 text-sm text-red-700 dark:border-red-800 dark:bg-red-950/30 dark:text-red-300">
            {{ session('error') }}
        </div>
    @endif

    @livewire('plan-selector')
</x-layout>
