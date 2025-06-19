<?php

namespace App\Console\Commands;

use App\Models\Video;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GetVideoLengthsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'videos:get-lengths';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and update video lengths from Bunny CDN';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $client = new Client();
        $videos = Video::all();
        
        $this->info("Found {$videos->count()} videos without duration.");
        $bar = $this->output->createProgressBar($videos->count());
        
        foreach ($videos as $video) {
            try {
                $response = $client->request('GET', "https://video.bunnycdn.com/library/{$video->library_id}/videos/{$video->video_id}", [
                    'headers' => [
                        'AccessKey' => '389ab102-2f80-4aff-9fed5d887804-31ef-4caf',
                        'accept' => 'application/json',
                    ],
                ]);
                
                $responseData = json_decode($response->getBody(), true);
                
                if (isset($responseData['length'])) {
                    $video->duration = $responseData['length'];
                    $video->save();
                    $this->info("\nUpdated duration for video: {$video->name}");
                }
            } catch (\Exception $e) {
                Log::error("Failed to get length for video {$video->id}: " . $e->getMessage());
                $this->error("\nFailed to get length for video: {$video->name}");
            }
            
            $bar->advance();
        }
        
        $bar->finish();
        $this->newLine();
        $this->info('Video length update completed!');        
        return Command::SUCCESS;
    }
} 