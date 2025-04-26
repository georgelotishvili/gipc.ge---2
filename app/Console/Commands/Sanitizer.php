<?php

namespace App\Console\Commands;

use App\Actions\Abecert\ImageSanitizerAction;
use App\Actions\Abecert\QuestionSanitizerAction;
use App\Actions\Abecert\UserSanitizerAction;
use Illuminate\Console\Command;

class Sanitizer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sanitizer';

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
        QuestionSanitizerAction::execute();
        UserSanitizerAction::execute();
    }
}
