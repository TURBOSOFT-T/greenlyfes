<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessagePost extends FormRequest
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
            'message' => ['required', 'string', 'max:1000'],
            'email' => ['sometimes', 'required', 'string', 'email', 'max:255'],
        ];
    }
}
