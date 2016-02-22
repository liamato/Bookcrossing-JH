<?php

namespace App\Http\Requests;

class ApiUserUpdate extends JsonRequest
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
            'name' => 'string|max:255',
            'email' => 'email|unique:users,email',
            'password' => 'string',
            'school_id' => 'sometimes|required|integer|exists:schools,id',
            'super' => 'boolean'
        ];
    }
}