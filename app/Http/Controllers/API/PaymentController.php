<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function callback(Request $request)
    {
        try {
            $userInfo = json_decode($request->merchant_data, true);
            $userId = $userInfo['user_id'];
            $subscriptionType = $userInfo['subscription_type'];
            $orderStatus = $request->order_status;
            $additionalInfo = json_decode($request->additional_info, true);
            $actualAmount = $additionalInfo['actual_amount'] ?? 0;
            if (!$userId || !$subscriptionType) {
                throw new \Exception('Missing user information');
            }
    
            $endsAt = null;
            switch ($actualAmount / 100) {
                case 150:
                    $endsAt = $additionalInfo['order_time']->addDays(7);
                    break;
                case 350:
                    $endsAt = $additionalInfo['order_time']->addDays(30);
                    break;
                case 1150:
                    $endsAt = $additionalInfo['order_time']->addDays(365);
                    break;
            }
    
            $payment = Payment::create([
                'user_id' => $userId,
                'subscription_type' => $subscriptionType,
                'order_status' => $orderStatus,
                'actual_amount' => $actualAmount / 100,
                'order_id' => $additionalInfo['order_id'],
                'card_type' => $additionalInfo['card_type'] ?? null,
                'order_time' => Carbon::createFromFormat('d.m.Y H:i:s', urldecode($additionalInfo['order_time'])),
                'bank_name' => $additionalInfo['bank_name'] ?? null,
                'payment_method' => $additionalInfo['payment_system'] ?? null,
                'transaction_id' => $additionalInfo['transaction_id'] ?? null,
            ]);

            if ($orderStatus == 'approved') {
                if (!$endsAt) {
                    throw new \Exception('Subscription duration could not be determined from payment amount');
                }
                    Subscription::updateOrCreate(
                    ['user_id' => $userId],
                    [
                        'type' => $subscriptionType,
                        'is_active' => true,
                        'starts_at' => $additionalInfo['order_time'] ?? now(),
                        'ends_at' => $endsAt,
                    ]
                );
            }
    
            return response()->json(['success' => true]);
    
        } catch (\Exception $e) {
            Log::error('Payment callback error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
