<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyPostRequest extends FormRequest
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
            'phone' => 'required',
            'address' => 'required|string|max:255',
            'city_id' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Имя компании не корректно',
            'phone.required' => 'Телефон не корректный',
            'address.required' => 'Адресс не корректный',
            'city_id.required' => 'Не указан город',
        ];
    }
}
