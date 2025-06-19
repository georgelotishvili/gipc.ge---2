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
        $validPrices = \App\Models\Pricing::pluck('price')->toArray();
        $validTypes = \App\Models\Plan::pluck('name')->toArray();

        return [
            'amount' => [
                'required',
                'integer',
                Rule::in($validPrices)
            ],
            'type' => [
                'required',
                'string',
                Rule::in($validTypes)
            ],
            'user' => [
                'required',
                'integer',
                Rule::exists('users', 'id')
            ]
        ];
    }


    protected function prepareForValidation(): void
    {
        $this->merge([
            'amount' => (int) $this->route('amount'),
            'type' => $this->input('type'),
            'user' => auth()->user()->id
        ]);
    }

    protected function failedValidation(Validator $validator): HttpResponseException
    {
        throw new HttpResponseException(
            redirect()->route('pricing')
        );
    }
}
