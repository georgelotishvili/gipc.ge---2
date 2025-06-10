<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Classes\Flitt\Payment;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    private const CURRENCY = 'GEL';
    private const LANGUAGE = 'ka';
    private const REQUIRED_RECTOKEN = 'Y';


    public function __construct(protected Payment $payment)
    {
    }

    public function buySubscription(Plan $plan)
    {
        try {
            $amount = $plan->plan_price * 100;
            $data = [
                'currency' => self::CURRENCY,
                'lang' => self::LANGUAGE,
                'amount' => $amount,
                'required_rectoken' => self::REQUIRED_RECTOKEN,
                'merchant_data' => [
                    'user_id' => auth()->user()->id,
                    'plan_id' => $plan->id,
                    'plan_type_id' => $plan->plan_type_id,
                    'subscription_end' => auth()->user()->subscription?->ends_at ?: now(),
                ]
            ];
            $this->payment->createOrder($data, $amount);
        } catch (\Throwable $e) {
            Log::error('Error creating subscription: '. $e->getMessage());
        }
    }

}
