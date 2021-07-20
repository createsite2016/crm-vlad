<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name'      => 'required',
            'phone'     => 'required',
            'email'     => 'required',
            'role_id'   => 'required',
            'city_id'   => 'required',
            'car_id'    => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'      => 'Имя не указано',
            'phone.required'     => 'Телефон не указан',
            'email.required'     => 'Почта не указана',
            'role_id.required'   => 'Роль сотрудника не указана',
            'city_id.required'   => 'Не указан город',
            'car_id.required'    => 'Автомобиль не указан',
        ];
    }
}
