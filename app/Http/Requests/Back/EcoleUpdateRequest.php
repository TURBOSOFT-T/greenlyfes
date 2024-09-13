<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Slug;

class EcoleUpdateRequest extends FormRequest
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
        $regex = '/^[A-Za-z0-9-éèàù]{1,50}?(,[A-Za-z0-9-éèàù]{1,50})*$/';
        $id = $this->ecole ? ',' . $this->ecole->id : '';

        return $rules = [
            'title' => 'nullable|max:255',
            'body' => 'nullable|max:65000',
        //    'slug' => ['nullable', 'max:255', new Slug, 'unique:ecoles,slug' . $id],
            'excerpt' => 'nullable|max:5000',
            'meta_description' => 'nullable|max:560',
            'meta_keywords' => 'nullable|regex:' . $regex,
            'seo_title' => 'nullable|max:560',
            'image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif',
            'filieres' => 'nullable',
           // 'tags' => 'nullable|regex:' . $regex,
        ];[

            'slug.unique' => 'champ unique',
        ];

        
        
    }

    public function messages()
    {
        return [
            'filieres.required' => 'Veuillez sélectionner au moins une filière.',
            'slug.unique' => 'Le slug a déjà été pris.',
        ];
    }
}
