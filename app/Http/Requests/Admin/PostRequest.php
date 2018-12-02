<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|min:3|max:191',
            'image' => 'image|max:8000|mimes:jpg,jpeg,png',
            'categories' => 'required|min:1',
            'tags' => 'required|min:1',
            'body' => 'required|min:10',
        ];
    }
}
