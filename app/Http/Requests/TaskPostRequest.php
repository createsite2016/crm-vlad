<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskPostRequest extends FormRequest
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
            'deadline' => 'required',
            'description' => 'required|string|max:255',
            'company_id' => 'required',
            'status_id' => 'required',
            'priority_id' => 'required',
            'user_id' => 'required',
            'player_id' => 'required',
            'device_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'deadline.required' => 'не указана',
            'description.required' => 'не заполнено',
            'company_id.required' => 'не указана',
            'status_id.required' => 'не указан статус',
            'priority_id.required' => 'не указан',
            'user_id.required' => 'не указан заказчик',
            'player_id.required' => 'не указан',
            'device_id.required' => 'не выбрано',
        ];
    }
}
