<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product' => 'required',
            'description' => 'required|min:20|max:700',
            'number' => 'required|regex:/[\d]{4}-[\d]{4}$/',
            'price' => 'required|integer|between:100,1000000',
        ];
    }

    public function messages()
    {
        return [
            'product.required' => 'Поле продукта обязательно',
            'description.required' => 'Поле описания обязательно',
            'description.min' => 'Поле описания должно быть от 20 символов',
            'description.max' => 'Поле описания должно быть до 700 символов',
            'number.required' => 'Поле номер обязательно',
            'number.regex' => 'Поле номер должно соответствовать формату 1234-1234',
            'price.required' => 'Поле цена обязательно',
            'price.between' => 'Поле цена должно быть больше 100 и меньше 1000000',
        ];
    }
}
