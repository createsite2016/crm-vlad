<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffPostRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'timework' => 'required',
            'address' => 'required|string|max:255',
            'city_id' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Имя склада не корректно',
            'timework.required' => 'Время работы не корректное',
            'address.required' => 'Адрес склада не корректный',
            'city_id.required' => 'Не указан город',
        ];
    }
}
