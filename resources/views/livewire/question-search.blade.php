<div class="relative flex-1">
    <div class="relative">
        <input
            wire:model.live.debounce.300ms="search"
            type="text"
            class="w-full pl-12 pr-4 py-2.5 text-gray-700 placeholder-gray-500 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-500 transition-colors duration-200"
            placeholder="მოძებნეთ კითხვები..."
        >
        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
    </div>

    @if($search && !empty($searchResults))
        <div class="absolute z-50 w-full mt-2 bg-white rounded-lg shadow-lg border border-gray-100">
            @foreach($searchResults as $result)
                <a href="{{ route('admin.questions.edit', $result->id) }}" class="block p-4 hover:bg-gray-50 cursor-pointer border-b border-gray-100 last:border-b-0">
                    <div class="text-sm text-gray-600">#{{ $result->id }}</div>
                    <div class="text-gray-900">
                        {!! $this->highlightText($result->text, $search) !!}
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>