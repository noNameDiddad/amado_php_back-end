<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле имени обязательно',
            'email.required' => 'Поле email обязательно',
            'password.required' => 'Поле пароля обязательно',
            'password_confirm.required' => 'Поле подтверждения пароля обязательно',
            'password.same' => 'Пароли не одинаковые',
        ];
    }
}
