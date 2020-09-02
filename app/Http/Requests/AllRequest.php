<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class AllRequest extends FormRequest
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
            'order_by_price' => 'in:asc,desc',
            'order_by_created_at' => 'in:asc,desc',
            'pagination_per_page' => 'integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'in' => "Параметр :attribute должен иметь значение 'asc' или 'desc'",
            'integer' => "Параметр :attribute должен быть целочисленным",
            'min' => 'Параметр :attribute должен быть не меньше :min',
        ];
    }
}
