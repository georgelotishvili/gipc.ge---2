<x-admin.layout>
    <div class="min-h-screen bg-white dark:bg-dark relative overflow-hidden">
        <div class="relative z-10 max-w-[1920px] mx-auto px-6 py-8">
            <!-- Header -->
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">
                    კურსის <span class="bg-gradient-to-r from-primary-400 to-blue-400 bg-clip-text text-transparent">ვიდეოები</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                    მართეთ თავის ვიდეო გაკვეთილები
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="mb-8 flex justify-between items-center">
                <a href="{{ route('admin.courses.chapters', $course) }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-md transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    უკან დაბრუნება
                </a>
                
                <a href="{{ route('admin.courses.chapters.videos.create', ['course' => $course, 'chapter' => $chapter]) }}" 
                   class="inline-flex items-center px-4 py-2 bg-primary-500 hover:bg-primary-600 text-white text-sm font-medium rounded-md transition-colors duration-200">
                    <i class="fas fa-plus mr-2"></i>
                    ახალი ვიდეოს დამატება
                </a>
            </div>

            @if($chapter->videos->count() > 0)
                <!-- Videos List -->
                <div class="max-w-4xl mx-auto space-y-4">
                    @foreach($chapter->videos as $video)
                    @php
                    $client = new \GuzzleHttp\Client();

                    // $response = $client->request('GET', $video->video_url, [
                    //     'headers' => [
                    //         'AccessKey' => '389ab102-2f80-4aff-9fed5d887804-31ef-4caf',
                    //         'accept' => 'application/json',
                    //     ],
                    // ]);

                    // $response = $client->request('GET', 'https://vz-b6104acb-6e4.b-cdn.net/9d566441-ae03-4b17-ac16-30fd0a2fcdaf/thumbnail.jpg', [
                    //     'headers' => [
                    //         'AccessKey' => '389ab102-2f80-4aff-9fed5d887804-31ef-4caf',
                    //         'accept' => 'application/json',
                    //     ],
                    // ]);

                    // $client = new \GuzzleHttp\Client();

                    // $response = $client->request('GET', 'https://video.bunnycdn.com/library/382670/videos/9d566441-ae03-4b17-ac16-30fd0a2fcdaf', [
                    // 'headers' => [
                    //     'AccessKey' => '389ab102-2f80-4aff-9fed5d887804-31ef-4caf',
                    //     'accept' => 'application/json',
                    // ],
                    // ]);

                    // echo $response->getBody();

                    // dd($response);
                    @endphp
                    <div class="bg-white dark:bg-dark-2 rounded-lg shadow-sm flex">
                        <a href="{{ route('admin.courses.chapters.videos.show', ['course' => $course, 'chapter' => $chapter, 'video' => $video]) }}" target="_blank">
                        <div class="w-48 h-32 relative bg-gray-100 dark:bg-dark-3 rounded-l-lg flex-shrink-0">
                            @if($video->thumbnail)
                                <img src="{{ Storage::url($video->thumbnail) }}" alt="{{ $video->title }}" class="absolute inset-0 w-full h-full object-cover rounded-l-lg">
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
                                <div class="text-sm text-gray-500">
                                    <span>{{ $video->duration ?? '00:00' }} წუთი</span>
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
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-12">
                    <div class="w-48 h-48 relative mb-8">
                        <div class="absolute inset-0 flex items-center justify-center animate-pulse">
                            <i class="fas fa-video text-8xl text-primary-400"></i>
                        </div>
                        <div class="absolute inset-0 border-4 border-t-primary-500 border-r-transparent border-b-transparent border-l-transparent rounded-full animate-spin"></div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-2">ვიდეოები არ არის დამატებული</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-center max-w-md">
                        დაამატეთ პირველი ვიდეო ამ თავისთვის ზემოთ მოცემული ღილაკის გამოყენებით
                    </p>
                </div>
            @endif
        </div>
    </div>

    @push('styles')
        <style>
            [x-cloak] { display: none !important; }
        </style>
    @endpush

</x-admin.layout>
