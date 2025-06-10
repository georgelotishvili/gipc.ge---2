<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use App\Classes\Flitt\Payment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckSubscriptionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-subscriptions-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command checks subscriptions and renew them if needed.';

    /**
     * Execute the console command.
     */
    public function handle(Payment $payment): void
    {
        try {
            $subscriptions = Subscription::query()
                ->select('*')
                ->selectRaw('DATEDIFF(ends_at, NOW()) AS days_left')
                ->get();
            foreach ($subscriptions as $subscription) {
                $diffInDays = abs($subscription->days_left);
                $this->info($diffInDays);
                if(abs($diffInDays) <= $subscription->planType->payment_days) {
                    $data = $payment->getRecurrentData($subscription);
                    //Todo: Waiting to enable Recurrent payment From Bank
                    dd($payment->recurringPayment($data));
                }
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            Log::error('Recurrent Payment Error'.$e->getMessage());
        }
    }
}
