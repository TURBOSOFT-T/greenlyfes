<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Slug;



class ProductRequest extends FormRequest
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
        $id = $this->product ? ',' . $this->product->id : '';

        return $rules = [
            'name' => 'required|max:255',
            'slug' => ['required', 'max:255', new Slug, 'unique:products,slug' . $id],
          //  'category_id' => 'exists:categories,id',
           // 'image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif',
           'image' => 'sometimes|required|file|mimetypes:image/*',

            'description' => 'required|string',
    
            'category_id' => 'exists:categories,id',
        ];
    }

}
