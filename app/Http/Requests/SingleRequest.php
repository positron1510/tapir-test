<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SingleRequest extends FormRequest
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
            'id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Идентификатор обязателен',
            'integer' => 'Идентификатор записи должен быть целым числом',
        ];
    }
}
