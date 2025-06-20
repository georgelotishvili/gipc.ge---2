<?php

namespace App\Console\Commands;

use App\Actions\Abecert\VideoWeightSanitizeAction;
use Illuminate\Console\Command;

class VideoWeightSanitizerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'video-weight-sanitizer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sanitizes video weights based on their numbering';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting video weight sanitization...');
        VideoWeightSanitizeAction::execute();
        $this->info('Video weight sanitization completed!');
    }
} 