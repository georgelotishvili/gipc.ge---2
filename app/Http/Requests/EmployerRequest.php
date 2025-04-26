<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\WorkTimeType;
use Illuminate\Support\Facades\Auth;

class EmployerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (Auth::check()) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'worktime' => ['required', 'string', 'in:' . implode(',', array_column(WorkTimeType::cases(), 'value'))],
            'salary' => ['required', 'numeric', 'min:0'],
            'description' => ['required', 'string'],
            'skills' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'website' => ['nullable', 'url', 'max:255'],
            'social' => ['nullable', 'string', 'max:1000'],
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
            'name.required' => 'სახელი სავალდებულოა',
            'name.max' => 'სახელი არ უნდა აღემატებოდეს 255 სიმბოლოს',
            'position.required' => 'პოზიცია სავალდებულოა',
            'position.max' => 'პოზიცია არ უნდა აღემატებოდეს 255 სიმბოლოს',
            'city.max' => 'ქალაქი არ უნდა აღემატებოდეს 255 სიმბოლოს',
            'worktime.required' => 'სამუშაო განაკვეთი სავალდებულოა',
            'worktime.in' => 'არასწორი სამუშაო განაკვეთი',
            'salary.required' => 'ხელფასი სავალდებულოა',
            'salary.numeric' => 'ხელფასი უნდა იყოს რიცხვი',
            'salary.min' => 'ხელფასი არ შეიძლება იყოს უარყოფითი',
            'description.required' => 'აღწერა სავალდებულოა',
            'skills.required' => 'უნარები სავალდებულოა',
            'skills.max' => 'უნარები არ უნდა აღემატებოდეს 255 სიმბოლოს',
            'email.required' => 'ელ-ფოსტა სავალდებულოა',
            'email.email' => 'გთხოვთ შეიყვანოთ სწორი ელ-ფოსტის ფორმატი',
            'email.max' => 'ელ-ფოსტა არ უნდა აღემატებოდეს 255 სიმბოლოს',
            'phone.max' => 'ტელეფონის ნომერი არ უნდა აღემატებოდეს 20 სიმბოლოს',
            'website.url' => 'გთხოვთ შეიყვანოთ სწორი ვებ-საიტის მისამართი',
            'website.max' => 'ვებ-საიტის მისამართი არ უნდა აღემატებოდეს 255 სიმბოლოს',
            'social.max' => 'სოციალური ბმულები არ უნდა აღემატებოდეს 1000 სიმბოლოს',
        ];
    }
} 