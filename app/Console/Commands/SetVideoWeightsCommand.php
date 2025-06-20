<?php

namespace App\Console\Commands;

use App\Models\Video;
use Illuminate\Console\Command;

class SetVideoWeightsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'videos:set-weights';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set video weights based on their numbering in the name';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $videos = Video::all();
        $updatedCount = 0;

        foreach ($videos as $video) {
            // Check if the name starts with a number followed by a dot
            if (preg_match('/^(\d+)\./', $video->name, $matches)) {
                $weight = (float) $matches[1];
                $video->weight = $weight;
                
                // Remove the number and dot from the beginning of the name
                $newName = preg_replace('/^\d+\.\s*/', '', $video->name);
                
                // Update the video with new name and weight
                $video->name = $newName;
                $video->save();
                $updatedCount++;
            }
        }

        $this->info("Updated weights for {$updatedCount} videos.");
    }
} 