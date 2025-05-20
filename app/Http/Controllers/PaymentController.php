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


    //PaymentRequest $request როუტის პარამეტრის ვალიდაცია 0 და სხვა პარამეტრი ვეღარ გაგეპარება ვერასდროს რომც გაიპაროს დაგაბუნებს უკან
    public function createOrder(PaymentRequest $request)
    {
        $amount = $request->input('amount');

        //ამიტომ ეს if ქონდიშენალები ამოვარდება აქედან შენ წაშალაე მერე ეს კომენტარები რო არ ვშლი რომ დაინახო
//        if (!$amount) {
//            return redirect()->back()->with('error', 'Price not found');
//        }
//
//        $amount = (int) $amount;
//        if ($amount <= 0) {
//            return redirect()->back()->with('error', 'Invalid price value');
//        }
//

        $type = match (true) {
            $amount == 150 => SubscriptionType::WEEKLY,
            $amount == 350 => SubscriptionType::MONTHLY,
            $amount == 1150 => SubscriptionType::YEARLY,
        };

        Configuration::setMerchantId(config('flitt.merchant_id'));
        Configuration::setSecretKey(config('flitt.payment_key'));
        Configuration::setApiVersion('1.0');
        Configuration::setRequestType('json');


        //ეს თუ არ გაატანე პარამეტრებში  ისე ქოლბექზე ვერ მიიღებ იუზერ აიდს auth()->user()->id  არ იმუშავბეს
        // იმიტორო შენ არ შედიხარ სხვა სერვერი გიგზავნის რექვესთს
        //        'merchant_data' => [
        //            'user_id' => auth()->user()->id,
        //            'subscription_type' => $type,
        //        ]

        $checkoutData = [
            'currency' => 'GEL',
            'amount' => $amount * 100,
            'response_url' => route('payment.response.status'),
            'server_callback_url' => route('api.payment.callback'),
            'merchant_data' => [
                'user_id' => auth()->user()->id,
                'subscription_type' => $type,
            ]
        ];
        $data = \Flitt\Checkout::url($checkoutData);
        $data->getUrl();
        $data->toCheckout();
    }


//    // მეთიდებს დაუსერე retrn type - ები ყოველთვის ამის void არის (void - არ გიბრუნებს არაფერს უბრალოდ საქმეს ასრულებს)
//    public function handleCallback(Request $request): void
//    {
//
//        Log::info('Payment callback received', $request->all());
//
//        $paymentStatus = $request->input('status');
//        $amount = $request->input('amount') / 100;
//        $paymentDate = $request->input('date') ? Carbon::parse($request->input('date')) : now();
//
////        if ($paymentStatus === 'success') {
//            $type = match (true) {
//                $amount == 150 => SubscriptionType::WEEKLY,
//                $amount == 350 => SubscriptionType::MONTHLY,
//                $amount == 1150 => SubscriptionType::YEARLY,
//            };
//
//            $endsAt = match ($type) {
//                SubscriptionType::WEEKLY => $paymentDate->copy()->addWeek(),
//                SubscriptionType::MONTHLY => $paymentDate->copy()->addMonth(),
//                SubscriptionType::YEARLY => $paymentDate->copy()->addYear(),
//            };
//
//            Subscription::create([
//                'user_id' => auth()->user()->id,
//                'type' => $type,
//                'starts_at' => $paymentDate,
//                'ends_at' => $endsAt,
//            ]);
//
////            session()->flash('success', 'Payment is successfully processed!');
////        } else {
////            session()->flash('error', 'Payment failed. Please try again.');
////        }
//        //არც ეს სეშენ ფლეში
//        // ეს რედირექტი არ გჭირდება აქ მარტო დატა გეგეზავნება შენ
////        return redirect('/');
//    }


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
