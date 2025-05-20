<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function callback(Request $request)
    {

        // $userinfo არის ერეი ამიტომ [] ამითმოგაქვს ინფრო
        // $request არის ობიქტი
        $userInfo = json_decode($request->merchant_data, true);
        $userId = $userInfo['user_id'];
        $subscriptionType = $userInfo['subscription_type'];
        $orderStatus = $request->order_status;
        $additionalInfo = json_decode($request->additional_info, true);
        return $additionalInfo;
        // აქ უნდა გააკეთო საბსქრიბშენის ამბები და ასევე უნდა შექმნა payments თეიბლი სადაც ტრანზაქციის დეტალებს შეინახავ ყველაფერი არაა საჭირო
        // აუცილებლად ჯერ შეინახე payments და სტატუსის შესაბამისად შეინახე მერე საბსქიფშენი ანუ თუ სტატუსი approved არის გადახდის სტატუსს ეს გიბუნებს - order_status
        // response_status ეს არაფერ შუაშია ეს სულ success იქნება ხოლმე იშვათად რომ failure იყოს
        // payment თეიბლში შეინახე actual_amount, order_status, order_id, order_time, card_type [payment_time, transaction_id, bank_name, payment_method (ამათ მიიღებ $additionalInfo აქედან $additionalInfo['transaction_id'] -ასე)
    }
}
