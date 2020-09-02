<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;


class StoreRequest extends FormRequest
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
        Validator::extend('count_photos', function ($attribute, $value, $parameters, $validator) {
            $count = count($value);
            return ($count >= 1 && $count <= 3) ? true : false;
        });

        return [
            'title' => 'required|min:3|max:200',
            'description' => 'required|min:3|max:1000',
            'price' => 'required|integer|between:0,100000000',
            'photos' => 'required|array|count_photos'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле должно быть заполнено',
            'min' => 'Поле должно содержать не меньше :min символов',
            'max' => 'Поле должно содержать не больше :max символов',
            'array' => 'Поле должно быть массивом',
            'integer' => 'Поле должно быть целым числом',
            'between' => 'Поле должно быть числом в диапазоне от :min до :max',
            'count_photos' => 'Количество фотографий должно быть от 1 до 3',
        ];
    }
}
