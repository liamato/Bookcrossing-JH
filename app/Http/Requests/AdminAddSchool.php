<?php

namespace App\Http\Requests;

class AdminAddSchool extends JsonRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isSuper();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:40',
            'slug' => 'required|string|max:30|unique:schools,slug',
            'uname' => 'required|string|max:255',
            'umail' => 'required|string|email|max:255|unique:users,email',
            'upassword' => 'required|string|max:255',
            'cname' => 'required|string|max:40',
            'cslug' => 'required|string|max:30|unique:categories,slug',
        ];
    }
}
