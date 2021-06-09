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
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'key' => [ Rule::in('19216801')],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Имя не корректно',
            'email.required' => 'Email не корректный',
            'password.required' => 'Пароль не корректный',
            'key.in' => 'секретный ключ не верный',
        ];
    }
}
