<?php

namespace App\Http\Controllers;

use App\Enums\SubscriptionType;
use App\Models\Subscription;
use Carbon\Carbon;
use Flitt\Configuration;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function createOrder($price)
    { 
        if (!$price) {
            return redirect()->back()->with('error', 'Price not found');
        }

        $price = (int) $price;
        if ($price <= 0) {
            return redirect()->back()->with('error', 'Invalid price value');
        }

        Configuration::setMerchantId(config('flitt.merchant_id'));
        Configuration::setSecretKey(config('flitt.payment_key'));

        $checkoutData = [
            'currency' => 'GEL',
            'amount' => $price * 100,
            'response_url' => 'http://127.0.0.1:8000',
            'server_callback_url' => 'http://127.0.0.1:8000/payment/callback',
        ];

        try {
            $data = \Flitt\Checkout::url($checkoutData);
            $url = $data->getUrl();
            $data->toCheckout();
            return redirect($url);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Payment initialization failed: '.$e->getMessage());
        }
    }

    public function handleCallback(Request $request)
    {
        
        $paymentStatus = $request->input('status');
        $amount = $request->input('amount') / 100;
        $paymentDate = $request->input('date') ? Carbon::parse($request->input('date')) : now();

        if ($paymentStatus === 'success') {
            $type = match (true) {
                $amount == 150 => SubscriptionType::WEEKLY,
                $amount == 350 => SubscriptionType::MONTHLY,
                $amount == 1150 => SubscriptionType::YEARLY,
            };

            $endsAt = match ($type) {
                SubscriptionType::WEEKLY => $paymentDate->copy()->addWeek(),
                SubscriptionType::MONTHLY => $paymentDate->copy()->addMonth(),
                SubscriptionType::YEARLY => $paymentDate->copy()->addYear(),
            };

            Subscription::create([
                'user_id' => auth()->user()->id,
                'type' => $type,
                'starts_at' => $paymentDate,
                'ends_at' => $endsAt,
            ]);

            session()->flash('success', 'Payment is successfully processed!');
        } else {
            session()->flash('error', 'Payment failed. Please try again.');
        }

        return redirect('/');
    }
}
