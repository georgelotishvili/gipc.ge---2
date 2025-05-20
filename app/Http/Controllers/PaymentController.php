<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatusEnum;
use App\Enums\SubscriptionType;
use App\Http\Requests\Payment\PaymentRequest;
use App\Http\Requests\Payment\PaymentStatusRequest;
use Flitt\Configuration;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function createOrder(PaymentRequest $request)
    {
        $amount = $request->input('amount');

        $type = match (true) {
            $amount == 150 => SubscriptionType::WEEKLY,
            $amount == 350 => SubscriptionType::MONTHLY,
            $amount == 1150 => SubscriptionType::YEARLY,
        };

        Configuration::setMerchantId(config('flitt.merchant_id'));
        Configuration::setSecretKey(config('flitt.payment_key'));
        Configuration::setApiVersion('1.0');
        Configuration::setRequestType('json');

        $checkoutData = [
            'currency' => 'GEL',
            'amount' => $amount * 100,
            'response_url' => route('payment.response.status'),
            'server_callback_url' => route('api.payment.callback'),
            'merchant_data' => [
                'user_id' => auth()->user()->id,
                'subscription_type' => $type->name,
                'subscription_end' => auth()->user()->subscription->ends_at ?: now(),
            ]
        ];
        $data = \Flitt\Checkout::url($checkoutData);
        $data->getUrl();
        $data->toCheckout();
    }


    public function paymentResponse(Request $request)
    {
        $status = $request->order_status;
        return redirect()->route('payment.status', $status);
    }

    public function status(PaymentStatusRequest $request)
    {
        $status = $request->status;
        $statusDescription = PaymentStatusEnum::from($status)->description();
        $statusTitle = PaymentStatusEnum::from($status)->title();
        return view('payment.thankYou', compact('statusDescription', 'statusTitle', 'status'));
    }


}
