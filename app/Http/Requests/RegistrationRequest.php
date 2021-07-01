<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegistrationRequest extends FormRequest
{
    /**
     * @var mixed
     */
    public $key;

    /**
     * Определите, имеет ли пользователь право сделать этот запрос.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Правила проверки, применимые к запросу.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role_id' => 'required|integer',
            'city_id' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Имя не корректно',
            'phone.required' => 'Номер телефона не корректный',
            'email.required' => 'Email не корректный',
            'email.unique' => 'Такой email уже существует',
            'password.required' => 'Пароль не корректный',
            'role_id.required' => 'Не выбрана роль пользователя',
            'city_id.required' => 'Не выбран город пользователя',
        ];
    }
}
