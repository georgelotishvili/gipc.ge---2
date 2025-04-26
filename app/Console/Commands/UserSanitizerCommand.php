<?php

namespace App\Console\Commands;

use App\Actions\Abecert\UserSanitizerAction;
use App\Models\User;
use Illuminate\Console\Command;


class UserSanitizerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user-sanitizer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sanitizes user subscriptions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        UserSanitizerAction::execute();
    }
}
