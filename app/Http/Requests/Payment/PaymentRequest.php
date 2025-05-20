<?php

namespace App\Http\Requests\Payment;

use App\Enums\SubscriptionPricesEnum;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
//        $paymentAmount = $this->route('amount');
        return [
            'amount' => [
                'required',
                'integer',
                Rule::in(SubscriptionPricesEnum::values())
            ]
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'amount' => (int) $this->route('amount'),
        ]);
    }

    protected function failedValidation(Validator $validator): HttpResponseException
    {
        throw new HttpResponseException(
            redirect()->route('pricing')
        );
    }
}
