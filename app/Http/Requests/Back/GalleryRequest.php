<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Slug;

class GalleryRequest extends FormRequest
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
            'titre' => 'required|max:255',
             //  'image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif',
             'image' => 'sometimes|required|file|mimetypes:image/*',
             'video'=>'nullable',
           //  'video' => ' sometimes|required',
       //    'video' => 'required|file|mimetypes:video/*',
         //  'video' => 'sometimes|required|file|mimetypes:video/mp4,video/mpeg,video/ogg,video/webm,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/3gpp,video/3gpp2',
      
            //   'image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif',
            'description' => 'required|string',
        //    'slug' => ['required', 'max:255', new Slug, 'unique:homes,slug' . $id],

        ];
    }
}