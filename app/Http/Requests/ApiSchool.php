<?php

namespace App\Http\Requests;

class ApiSchool extends JsonRequest
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
            'name' => 'required|string|max:255|unique:schools,name',
            'slug' => 'required|alpha_dash|max:255|unique:schools,slug'
        ];
    }
}