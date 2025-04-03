<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|between:1,5', // Оценка
            'author' => 'required|string', // Автор
            'content' => 'required|string' // Содержимое отзыва
        ];
    }

    public function messages(): array
    {
        return [
            'rating.required' => 'Поле "Оценка" обязательно для заполнения.',
            'rating.integer' => 'Поле "Оценка" должно быть целым числом.',
            'rating.between' => 'Поле "Оценка" должно быть в диапазоне от 1 до 5.',
            'author.required' => 'Поле "Автор" обязательно для заполнения.',
            'author.string' => 'Поле "Автор" должно быть строкой.',
            'content.required' => 'Поле "Содержимое" обязательно для заполнения.',
            'content.string' => 'Поле "Содержимое" должно быть строкой.'
        ];
    }

}
