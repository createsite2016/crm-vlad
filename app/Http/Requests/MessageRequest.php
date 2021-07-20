<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
            'sender_id'         => 'required|integer',
            'recipient_id'      => 'required|integer',
            'text'              => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'sender_id.required'    => 'Отправитель не указан',
            'recipient_id.unique'   => 'Получатель не указан',
            'text.unique'           => 'Текст письма не заполнен'
        ];
    }
}
