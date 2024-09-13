<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Slug;

class SponsorRequest extends FormRequest
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
        $id = $this->method() === 'PUT' ? ',' . basename($this->url()) : '';
        return $rules = [
          //  'title' => 'required|max:255',
            'titre' => 'nullable|max:255',
            'description' => 'nullable|max:605000',
          //  'icon' => 'nullable|required|image|mimes:jpeg,png,jpg,gif',
            'image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif',
           // 'body' => 'nullable|string',
            'slug' => ['required', 'max:255', new Slug, 'unique:sponsors,slug' . $id],

        ];
    }

}