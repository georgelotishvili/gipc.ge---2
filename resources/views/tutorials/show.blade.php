<x-layout>
    @php
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://video.bunnycdn.com/library/382670/videos/'.$video->video_id, [
        'headers' => [
            'AccessKey' => config('video.api_key'),
            'accept' => 'application/json',
        ],
        ]);

        // Convert the response body to a JSON object
        $responseData = json_decode($response->getBody(), true);

        // dd($responseData);
    @endphp
    <div class="min-h-screen bg-white dark:bg-dark relative overflow-hidden pt-24">
        <div class="relative z-10">
            <!-- Video Section -->
            <div class="w-full dark:bg-dark border-b border-gray-800 relative">
                <div class="container mx-auto px-4 relative">
                    <div class="max-w-6xl mx-auto py-8">
                        <!-- Full Width Video Player -->
                        <div class="w-full rounded-lg overflow-hidden shadow-lg">
                            <div style="position:relative;padding-top:56.25%;"><iframe src="https://iframe.mediadelivery.net/embed/{{$video->library_id}}/{{$video->video_id}}?autoplay=true&loop=false&muted=false&preload=true&responsive=true" loading="lazy" style="border:0;position:absolute;top:0;height:100%;width:100%;" allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture;" allowfullscreen="true"></iframe></div>

                        </div>

                        <!-- Video Info -->
                        <div class="p-6 bg-white dark:bg-gray-800 rounded-b-lg">
                            <h5 class="text-gray-900 dark:text-white text-2xl font-medium mb-2">{{ $video->name }}</h5>
                            <p class="text-gray-700 dark:text-gray-300 text-base mb-4">
                                {{ $video->description }}
                            </p>
                            <div class="flex items-center gap-4 text-sm text-gray-500 dark:text-gray-400">
                                <span class="flex items-center gap-2">
                                    <i class="far fa-eye"></i>
                                    {{ $responseData['views'] }} ნახვა
                                </span>
                                <span class="flex items-center gap-2">
                                    <i class="far fa-calendar"></i>
                                    {{ $responseData['dateUploaded'] }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="container mx-auto px-4 py-12">
                <div class="max-w-6xl mx-auto">
                    <!-- Video Info with Glass Effect -->
                    <div class="mb-12 p-8 bg-white/5 backdrop-blur-xl rounded-2xl border border-gray-200/10 dark:border-gray-700/30 shadow-lg">
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4 tracking-tight">
                            {{ $video->name }}
                        </h1>
                        <div class="flex flex-wrap items-center gap-6 text-gray-600 dark:text-gray-400 mb-6">
                            <span class="flex items-center gap-2 bg-gray-100 dark:bg-gray-800/50 px-3 py-1 rounded-full">
                                <i class="far fa-clock"></i>
                                {{ isset($video->duration) ? sprintf('%02d:%02d:%02d', floor($video->duration/3600), floor(($video->duration/60)%60), $video->duration%60) : '00:00:00' }}
                            </span>
                            <span class="flex items-center gap-2 bg-gray-100 dark:bg-gray-800/50 px-3 py-1 rounded-full">
                                <i class="far fa-calendar"></i>
                                {{ $video->created_at->format('d მარტი, Y') }}
                            </span>
                            <span class="flex items-center gap-2 bg-gray-100 dark:bg-gray-800/50 px-3 py-1 rounded-full">
                                <i class="far fa-eye"></i>
                                {{ $responseData['views'] }} ნახვა
                            </span>
                        </div>
                        <div class="prose prose-lg dark:prose-invert max-w-none">
                            <p class="text-gray-600 dark:text-gray-300">{{ $video->description }}</p>
                        </div>
                    </div>

                    <!-- Author Section with Enhanced Design -->
                    <div class="flex items-center gap-6 p-8 bg-gradient-to-r from-primary-500/10 to-blue-500/10 rounded-2xl backdrop-blur-sm border border-gray-200/20 dark:border-gray-700/30 shadow-lg mb-12">
                        <div class="relative">
                            <div class="absolute -inset-1 bg-gradient-to-r from-primary-500 to-blue-500 rounded-full blur opacity-70"></div>
                            <img src="https://api.dicebear.com/7.x/initials/svg?seed=GL&backgroundType=gradientLinear&backgroundColor=003c96" 
                                 alt="გიორგი ლოთიშვილი"
                                 class="relative w-16 h-16 rounded-full">
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">გიორგი ლოთიშვილი</h3>
                            <p class="text-gray-600 dark:text-gray-400">არქიტექტორი</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-layout> 