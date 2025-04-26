<?php

namespace App\Console\Commands;

use App\Actions\Abecert\ImageSanitizerAction;
use Illuminate\Console\Command;

class ImageSanitizer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'image-sanitizer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ImageSanitizerAction::execute();
    }
}
