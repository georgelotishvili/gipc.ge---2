<?php

namespace App\Console\Commands;

use App\Actions\Abecert\QuestionSanitizerAction;
use App\Models\Question;
use Illuminate\Console\Command;

class QuestionSanitizer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'question-sanitizer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sanitizes Questions, removes all questions that have no answers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        QuestionSanitizerAction::execute();
    }
}
