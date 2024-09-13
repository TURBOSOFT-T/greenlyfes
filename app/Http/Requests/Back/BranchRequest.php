<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Validation\Validator;
use App\Rules\Slug;

class BranchRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->method() === 'PUT' ? ',' . basename($this->url()) : '';
        return  $rules = [

            'title' => 'required',
         //   'slug' => ['required', 'max:255', new Slug, 'unique:branches,slug' . $id],
            'description' => 'required',
           // 'department_id' => ['required', 'numeric'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => $validator->errors(),
            'data' => null,
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}