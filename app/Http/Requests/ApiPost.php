<?php

namespace App\Http\Requests;

class ApiPost extends JsonRequest
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
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'author' => 'sometimes|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'parent' => 'sometimes|required|integer|exists:posts,id',
            'school_id' => 'sometimes|required|integer|exists:schools,id'
        ];
    }
}