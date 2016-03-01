<?php

namespace App\Http\Requests;

class ApiVideo extends JsonRequest
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
            'code' => ['required','string','unique:videos,code','size:11','regex:/^[A-Za-z0-9\_\-]{11}$/'],
            'author' => 'required|string',
            'trailer' => 'required|boolean',
            'school_id' => 'sometimes|required|integer|exists:schools,id'
        ];
    }
}
