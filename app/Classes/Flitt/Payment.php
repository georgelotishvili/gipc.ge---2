<?php

namespace App\Classes\Flitt;
use App\Models\Subscription;
use Carbon\Carbon;
use Flitt\Api\Payment\Rectoken;
use Flitt\Checkout;
use Flitt\Configuration;
use Flitt\Helper\ApiHelper;
use Illuminate\Support\Facades\Log;

class Payment
{
    protected string $merchantId;
    protected string $secretKey;
    protected string $callbackUrl;
    protected string $recurrentCallbackUrl;
    protected string $responseUrl;
    protected string $orderId;

    public function __construct()
    {
        $this->merchantId = config('flitt.merchant_id');
        $this->secretKey = config('flitt.secret_key');
        $this->callbackUrl = config('flitt.callback_url');
        $this->recurrentCallbackUrl = config('flitt.recurrent_callback_url');
        $this->responseUrl = config('flitt.response_url');
        $this->orderId = $this->generateOrderId($this->merchantId);
    }

    public function createOrder(array $data, int $amount)
    {
        if($amount > 0){
            try {
                $params = array_merge([
                    'response_url' => $this->responseUrl,
                    'server_callback_url' => $this->callbackUrl,
                ], $data);
                $this->sendRequest($params);
            } catch (\Exception $e) {
                return response(['error' => $e->getMessage()], 500);
            }
        }
    }


    private function sendRequest(array $data): void
    {
        Configuration::setMerchantId(config('flitt.merchant_id'));
        Configuration::setSecretKey(config('flitt.secret_key'));
        Configuration::setApiVersion('1.0');
        Configuration::setRequestType('json');

        $data = Checkout::url($data);
        $data->getUrl();
        $data->toCheckout();
    }


    public function recurringPayment(array $data)
    {
        try {
            Configuration::setMerchantId(config('flitt.merchant_id'));
            Configuration::setSecretKey(config('flitt.secret_key'));
            Configuration::setApiVersion('1.0');
            Configuration::setRequestType('json');
            $recToken = new Rectoken();
            return $recToken->get($data);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        return false;
    }

    public function generateSignature(Subscription $subscription): string
    {
        $amount = $subscription->plan->plan_price * 100;
        $merchantData = [
            'user_id' => $subscription->user_id,
            'plan_id' => $subscription->plan_id,
            'plan_type_id' => $subscription->plan_type_id,
            'subscription_end' => $subscription->ends_at ?: now(),
        ];
        $data = [
            'amount' => $amount,
            'currency' => 'GEL',
            'merchant_data' => json_encode($merchantData),
            'merchant_id' => $this->merchantId,
            'order_desc' =>'Order pay #: '.$this->orderId,
            'order_id' => $this->orderId,
            'rectoken' => $subscription->recToken,
            'server_callback_url' => $this->recurrentCallbackUrl,
        ];
        return Signature::generate($data);
    }

    public function getRecurrentData(Subscription $subscription): array
    {
        $amount = $subscription->plan->plan_price * 100;
        return [
            'amount' => $amount,
            'currency' => 'GEL',
            'merchant_data' => [
                'user_id' => $subscription->user_id,
                'plan_id' => $subscription->plan_id,
                'plan_type_id' => $subscription->plan_type_id,
                'subscription_end' => $subscription->ends_at ?: now(),
            ],
            'merchant_id' => $this->merchantId,
            'order_id' =>$this->orderId,
            'rectoken' => $subscription->recToken,
            'signature' => $this->generateSignature($subscription),
            'server_callback_url' => $this->recurrentCallbackUrl,
        ];
    }

    public function generateOrderId(string $merchantId): string
    {
        return ApiHelper::generateOrderID($merchantId ?: $this->merchantId);
    }
}
