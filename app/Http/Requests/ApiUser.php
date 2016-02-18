<?php

namespace App\Http\Requests;

class ApiUser extends JsonRequest
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'school_id' => 'sometimes|required|integer|exists:schools,id',
            'super' => 'sometimes|required|boolean'
        ];
    }
}