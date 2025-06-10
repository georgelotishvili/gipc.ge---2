<?php

namespace App\Http\Controllers\API;

use App\Classes\Flitt\Signature;
use App\Enums\PaymentStatusEnum;
use App\Enums\PlanTypesEnum;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PlanType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function callback(Request $request, Signature $signature)
    {
        $req = $request->all();
        $data = [
            'amount' => $req['amount'],
            'currency' => $req['currency'],
            'merchant_id' => $req['merchant_id'],
            'merchant_data' => $req['merchant_data'],
            'order_id' => $req['order_id'],
            'server_callback_url' => config('flitt.server_callback_url'),
        ];
        $generatedSignature = $signature->generate($data);
        try {
            $userInfo = json_decode($request->merchant_data, true);
            $additionalInfo = json_decode($request->additional_info, true);
            $userId = $userInfo['user_id'];
            $user = User::find($userId);
            $planType = PlanType::find($userInfo['plan_type_id']);
            $subscriptionEnds = $userInfo['subscription_end'];
            $orderStatus = $request->order_status;
            $actualAmount = (int) $request->actual_amount / 100 ?: 0;
            $orderTime = Carbon::createFromFormat('d.m.Y H:i:s', $request->order_time)->format('Y-m-d H:i:s');
            $subscriptionEndDate = Carbon::parse($subscriptionEnds)->addDays($planType->type_duration);
            if($user->activeSubscriptionType() === PlanTypesEnum::FREE->value){
                $subscriptionEndDate = now()->addDays($planType->type_duration);
            }
            $payment = new Payment;
            $payment->user_id = $userId;
            $payment->order_status = $orderStatus;
            $payment->actual_amount = $actualAmount;
            $payment->order_id = $request->order_id;
            $payment->card_type = $request->card_type ?: 'VISA';
            $payment->order_time = $orderTime;
            $payment->bank_name = $additionalInfo['bank_name'] ?? null;
            $payment->payment_method = $request->payment_system ?: 'card';
            $payment->transaction_id = $additionalInfo['transaction_id'] ?? null;
            if ($payment->save() && $orderStatus === PaymentStatusEnum::APPROVED->value) {
                try {
                    $starts_at = $user->subscription?->starts_at ?: Carbon::now();
                    $subscription = $user->subscription()->updateOrCreate(
                        ['user_id' => $userId],
                        [
                            'is_active' => true,
                            'starts_at' => $starts_at,
                            'plan_type_id' => $planType->id,
                            'recToken' => $request->rectoken,
                            'signature' => $generatedSignature,
                            'ends_at' => $subscriptionEndDate,
                        ]
                    );
                    $payment->subscription_id = $subscription->id;
                    $payment->save();
                    return response()->json([
                        'success' => 'Subscription created successfully.',
                    ]);
//                    Mail::to($user->email)->send(new PaymentMail($actualAmount,  $request->order_id, 'GEL', $orderTime));
                } catch (\Exception $e) {
                    Log::error('Payment callback error: ' . $e->getMessage());
                }
            } else {
                $user->subscription()->updateOrCreate(
                    ['user_id' => $userId],
                    [
                        'is_active' => false,
                        'plan_type_id' => $planType->id,
                    ]
                );
            }

        } catch (\Exception $e) {
            Log::error('Payment callback error: ' . $e->getMessage());
        }
    }
    public function callbackRecurrent(Request $request, Signature $signature)
    {
        $requestData = $request->response['response'];
//        return $requestData['merchant_data'];
        try {
            $userInfo = json_decode($requestData['merchant_data'], true);
            $additionalInfo = json_decode($requestData['additional_info'], true);
            $userId = $userInfo['user_id'];
            $user = User::find($userId);
            $planType = PlanType::find($userInfo['plan_type_id']);
            $subscriptionEnds = $userInfo['subscription_end'];
            $orderStatus = $requestData['order_status'];
            $actualAmount = (int) $requestData['actual_amount'] / 100 ?: 0;
            $orderTime = Carbon::createFromFormat('d.m.Y H:i:s', $requestData['order_time'])->format('Y-m-d H:i:s');
            $subscriptionEndDate = Carbon::parse($subscriptionEnds)->addDays($planType->type_duration);
            if($user->activeSubscriptionType() === PlanTypesEnum::FREE->value){
                $subscriptionEndDate = now()->addDays($planType->type_duration);
            }
            $payment = new Payment;
            $payment->user_id = $userId;
            $payment->order_status = $orderStatus;
            $payment->actual_amount = $actualAmount;
            $payment->order_id = $requestData['order_id'];
            $payment->card_type = $requestData['card_type'] ?: 'VISA';
            $payment->order_time = $orderTime;
            $payment->bank_name = $additionalInfo['bank_name'] ?? null;
            $payment->payment_method = $requestData['payment_system'] ?: 'card';
            $payment->transaction_id = $additionalInfo['transaction_id'] ?? null;
            if ($payment->save() && $orderStatus === PaymentStatusEnum::APPROVED->value) {
                try {
                    $starts_at = $user->subscription?->starts_at ?: Carbon::now();
                    $subscription = $user->subscription()->updateOrCreate(
                        ['user_id' => $userId],
                        [
                            'is_active' => true,
                            'starts_at' => $starts_at,
                            'plan_type_id' => $planType->id,
                            'recToken' => $requestData['rectoken'],
                            'signature' => $requestData['signature'],
                            'ends_at' => $subscriptionEndDate,
                        ]
                    );
                    $payment->subscription_id = $subscription->id;
                    $payment->save();
                    return response()->json([
                        'success' => 'Subscription created successfully.',
                    ]);
//                    Mail::to($user->email)->send(new PaymentMail($actualAmount,  $requestData['order_id, 'GEL', $orderTime));
                } catch (\Exception $e) {
                    Log::error('Payment callback error: ' . $e->getMessage());
                    return response()->json([$e->getMessage()], 400);
                }
            } else {
                $user->subscription()->updateOrCreate(
                    ['user_id' => $userId],
                    [
                        'is_active' => false,
                        'plan_type_id' => $planType->id,
                    ]
                );
            }

        } catch (\Exception $e) {
            Log::error('Payment callback error: ' . $e->getMessage());
            return response()->json([$e->getMessage()], 400);
        }
    }
}
