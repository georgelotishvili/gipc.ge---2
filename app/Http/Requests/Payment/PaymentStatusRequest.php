<?php

namespace App\Http\Requests\Payment;

use App\Enums\PaymentStatusEnum;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class PaymentStatusRequest extends FormRequest
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
        return [
            'status' => [
                'required',
                Rule::in(PaymentStatusEnum::values()),
            ]
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' =>  strtolower($this->route('status')),
        ]);
    }

    protected function failedValidation(Validator $validator): HttpResponseException
    {

        // ეს რამე ერორ ფიჯზე გაუშვი ასე არ უნდა იყოს!
        throw new HttpResponseException(
            redirect()->route('pricing')
        );
    }
}
