<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StorePostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'body' => ['required', 'string', 'min:10'],
            'slug' => [ 'string', 'unique:posts,slug']
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'სათაური აუცილებელია',
            'title.min' => 'სათაური უნდა შეიცავდეს მინიმუმ :min სიმბოლოს',
            'title.max' => 'სათაური არ უნდა აღემატებოდეს :max სიმბოლოს',
            'body.required' => 'კონტენტი აუცილებელია',
            'body.min' => 'კონტენტი უნდა შეიცავდეს მინიმუმ :min სიმბოლოს',
            'thumbnail.required' => 'სურათი აუცილებელია',
            'thumbnail.image' => 'ფაილი უნდა იყოს სურათი',
            'thumbnail.mimes' => 'სურათი უნდა იყოს ერთ-ერთი ფორმატი: jpeg, png, jpg, gif',
            'thumbnail.max' => 'სურათის ზომა არ უნდა აღემატებოდეს 2MB-ს',
        ];
    }
} 