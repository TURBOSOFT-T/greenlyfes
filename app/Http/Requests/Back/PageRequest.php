<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Slug;

class PageRequest extends FormRequest
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
        $id = basename($this->url());

        return $rules = [
            'title' => 'required|max:255',
            'body' => 'required|max:100000605000',
            'slug' => ['required', 'max:255', new Slug, 'unique:posts,slug,' . $id],
        ];
    }
}
