<div class="bg-white dark:bg-dark-2 rounded-lg shadow-sm flex">
    <a href="{{ route('admin.courses.chapters.videos.show', ['course' => $course, 'chapter' => $chapter, 'video' => $video]) }}" target="_blank">
        <div class="w-48 h-32 relative bg-gray-100 dark:bg-dark-3 rounded-l-lg flex-shrink-0">
            @if($video->imageUrl())
                <img src="{{ $video->imageUrl() }}" alt="{{ $video->name }}" class="absolute inset-0 w-full h-full object-cover rounded-l-lg">
            @else
                <div class="absolute inset-0 flex items-center justify-center">
                    <i class="fas fa-video text-gray-400 text-3xl"></i>
                </div>
            @endif
        </div>
    </a>

    <div class="p-4 flex-grow flex justify-between">
        <div class="flex flex-col justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ $video->title }}
                </h3>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 line-clamp-2">
                    {{ $video->description }}
                </p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-sm text-gray-500">
                    <span>{{ $this->getFormattedDuration() }} წუთი</span>
                </div>
                <div class="flex items-center gap-2">
                    <label for="weight-{{ $video->id }}" class="text-sm text-gray-500">რიგითობა:</label>
                    <input 
                        type="number" 
                        id="weight-{{ $video->id }}" 
                        wire:model="weight" 
                        wire:change="updateWeight"
                        class="w-28 text-sm border border-gray-300 dark:border-gray-600 rounded px-2 py-1 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 text-black dark:text-white"
                        step="any"
                        min="0"
                    >
                </div>
            </div>
        </div>

        <div class="flex flex-col justify-between items-end">
            <div class="flex gap-2">
                <a href="{{ route('admin.courses.chapters.videos.edit', ['course' => $course, 'chapter' => $chapter, 'video' => $video]) }}" 
                   class="inline-flex items-center px-3 py-1.5 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md transition-colors duration-200">
                    <i class="fas fa-edit mr-1.5"></i>
                    რედაქტირება
                </a>
                <form action="{{ route('admin.courses.chapters.videos.destroy', ['course' => $course, 'chapter' => $chapter, 'video' => $video]) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-md transition-colors duration-200">
                        <i class="fas fa-trash-alt mr-1.5"></i>
                        წაშლა
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>