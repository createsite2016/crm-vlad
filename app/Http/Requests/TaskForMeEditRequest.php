<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskForMeEditRequest extends FormRequest
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
            'status_id' => 'required',
            'image' => 'required',
            'image_finish' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'status_id.required'    => 'не указан статус',
            'image.required'        => 'нет фото начала пробега',
            'image_finish.required' => 'нет фото конца пробега',
        ];
    }
}
