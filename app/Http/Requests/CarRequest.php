<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
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
            'number'    => 'required',
            'user_id'   => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Марка авто не заполнена',
            'number.required' => 'Номер авто не указан',
            'user_id.required' => 'Сотрудник не указан',
        ];
    }
}
