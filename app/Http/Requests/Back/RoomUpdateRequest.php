<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Slug;

class RoomUpdateRequest extends FormRequest
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
      

        return $rules = [
            'name' => 'nullable|max:255',
            'body' => 'nullable|max:65000',
           // 'slug' => ['required', 'max:255', new Slug, 'unique:rooms,slug' . $id],
            'excerpt' => 'nullable|max:500',
            'meta_description' => 'nullable|max:160',
          
            'seo_title' => 'nullable|max:60',
            'image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif',
          ///  'logements' => 'required',
         
            'book_id' => 'exists:books,id',
        ];
    }
}
