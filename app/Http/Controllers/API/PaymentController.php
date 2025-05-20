<?php

namespace App\Http\Controllers\API;

use App\Enums\PaymentStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Subscription;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function callback(Request $request) : void
    {
        try {
            $userInfo = json_decode($request->merchant_data, true);
            $userId = $userInfo['user_id'];
            $user = User::find($userId);
            $subscriptionType = $userInfo['subscription_type'];
            $subscriptionEnds = $userInfo['subscription_end'];
            $orderStatus = $request->order_status;
            $additionalInfo = json_decode($request->additional_info, true);
            $actualAmount = (int) $request->actual_amount / 100 ?: 0;
            $orderTime = Carbon::createFromFormat('d.m.Y H:i:s', $request->order_time)->format('Y-m-d H:i:s');
            if (!$userId || !$subscriptionType) {
                throw new \Exception('Missing user information');
            }

            $subscriptionEndDate = match ($actualAmount) {
                150 => $subscriptionEnds ? Carbon::parse($subscriptionEnds)->addDays(7) : Carbon::now()->addDays(7),
                350 => $subscriptionEnds ? Carbon::parse($subscriptionEnds)->addDays(30) : Carbon::now()->addDays(30),
                1150 => $subscriptionEnds ? Carbon::parse($subscriptionEnds)->addDays(365) : Carbon::now()->addDays(365),
                default => throw new \Exception('Subscription duration could not be determined from payment amount'),
            };

            $payment = new Payment();
            $payment->user_id = $userId;
            $payment->subscription_type = $subscriptionType;
            $payment->order_status = $orderStatus;
            $payment->actual_amount = $actualAmount;
            $payment->order_id = $request->order_id;
            $payment->card_type = $request->card_type ?: 'VISA';
            $payment->order_time = $orderTime;
            $payment->bank_name = $additionalInfo['bank_name'] ?: null;
            $payment->payment_method = $request->payment_system ?: 'card';
            $payment->transaction_id = $additionalInfo['transaction_id'] ?: null;
            if($payment->save()){
                if ($orderStatus === PaymentStatusEnum::APPROVED->value) {
                    $starts_at = $user->subscription ? ($user->subscription->starts_at === null ? Carbon::now() : $user->subscription->starts_at) : Carbon::now();
                    $user->subscription()->updateOrCreate([],
                        [
                            'type' => $subscriptionType,
                            'is_active' => true,
                            'starts_at' => $starts_at,
                            'ends_at' => $subscriptionEndDate,
                        ]
                    );
                }
            }
        } catch (\Exception $e) {
            Log::error('Payment callback error: ' . $e->getMessage());
        }
    }
}
