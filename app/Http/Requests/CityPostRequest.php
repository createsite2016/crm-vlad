<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityPostRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:cities',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Имя города не корректно',
            'name.unique' => 'Такой город :input уже есть'
        ];
    }
}
