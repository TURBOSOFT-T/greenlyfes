<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConfigRequest extends FormRequest
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
       
            'image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif',
            'description' => 'nullable|string',
            'email' => 'required|email|max:255' ,
            'telephone' => 'required|max:255|',
  
           'image' => 'nullable|image|max:10240|mimes:jpg,jpeg,png,bmp,gif,svg,webp',
           'icon' => 'nullable|image|max:10240|mimes:jpg,jpeg,png,bmp,gif,svg,webp',
           'logoHeader'=> 'nullable|image|max:10240|mimes:jpg,jpeg,png,bmp,gif,svg,webp',
            'image'=>'nullable|image|max:10240|mimes:jpg,jpeg,png,bmp,gif,svg,webp',
            'imagelogin'=>'nullable|image|max:10240|mimes:jpg,jpeg,png,bmp,gif,svg,webp',
            'imagergister'=> 'nullable|image|max:10240|mimes:jpg,jpeg,png,bmp,gif,svg,webp',
            'imageabout'=>'nullable|image|max:10240|mimes:jpg,jpeg,png,bmp,gif,svg,webp',
            'imageservice'=>'nullable|image|max:10240|mimes:jpg,jpeg,png,bmp,gif,svg,webp',
            'imagefooter'=>'nullable|image|max:10240|mimes:jpg,jpeg,png,bmp,gif,svg,webp',
            'imageteam'=>'nullable|image|max:10240|mimes:jpg,jpeg,png,bmp,gif,svg,webp',
            'imageblog'=>'nullable|image|max:10240|mimes:jpg,jpeg,png,bmp,gif,svg,webp',
            'imagefaq'=>'nullable|image|max:10240|mimes:jpg,jpeg,png,bmp,gif,svg,webp',
            'imageservices'=>'nullable|image|max:10240|mimes:jpg,jpeg,png,bmp,gif,svg,webp',
            'imageclient'=>'nullable|image|max:10240|mimes:jpg,jpeg,png,bmp,gif,svg,webp',
            'imagecontact'=>'nullable|image|max:10240|mimes:jpg,jpeg,png,bmp,gif,svg,webp',
          
           
            'annee'=> 'nullable|numeric',
            'utilisateur'=> 'nullable|numeric',
            'dossier'=> 'nullable|numeric',
            'projet'=> 'nullable|numeric',
            

      
        ];
    }
}
