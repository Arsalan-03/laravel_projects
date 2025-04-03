<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'email' => 'required|email',
            'phone' => 'required|string|min:10',
            'name' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'postcode' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Поле "Email" обязательно для заполнения.',
            'email.email' => 'Пожалуйста, введите корректный адрес электронной почты.',
            'phone.required' => 'Поле "Телефон" обязательно для заполнения.',
            'phone.string' => 'Поле "Телефон" должно быть строкой.',
            'phone.min' => 'Поле "Телефон" должно содержать не менее :min символов.',
            'name.required' => 'Поле "Имя" обязательно для заполнения.',
            'name.string' => 'Поле "Имя" должно быть строкой.',
            'address.required' => 'Поле "Адрес" обязательно для заполнения.',
            'address.string' => 'Поле "Адрес" должно быть строкой.',
            'city.required' => 'Поле "Город" обязательно для заполнения.',
            'city.string' => 'Поле "Город" должно быть строкой.',
            'country.required' => 'Поле "Страна" обязательно для заполнения.',
            'country.string' => 'Поле "Страна" должно быть строкой.',
            'postcode.required' => 'Поле "Почтовый индекс" обязательно для заполнения.',
            'postcode.string' => 'Поле "Почтовый индекс" должно быть строкой.',
        ];
    }
}
