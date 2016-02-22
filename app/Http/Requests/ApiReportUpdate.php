<?php

namespace App\Http\Requests;

class ApiReportUpdate extends JsonRequest
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
            'title' => 'string|max:255',
            'body' => 'string',
            'author' => 'string|max:255',
            'school_id' => 'sometimes|required|integer|exists:schools,id'
        ];
    }
}