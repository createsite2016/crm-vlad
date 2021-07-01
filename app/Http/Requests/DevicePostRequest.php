<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DevicePostRequest extends FormRequest
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
            'volume' => 'required',
            'staff_id' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Имя оборудования не корректно',
            'volume.required' => 'количество не корректное',
            'staff_id.required' => 'Не указан склад',
        ];
    }
}
