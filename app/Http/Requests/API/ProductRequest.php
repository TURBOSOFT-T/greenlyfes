<?php

namespace App\Http\Requests\API;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Validation\Validator;
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
      //  $id = $this->produt ? ',' . $this->product->id : '';

        return $rules = [
            'name' => 'required|max:255',
            'slug' => ['required', 'max:255', new Slug, 'unique:products,slug' . $id],
          //  'category_id' => 'exists:categories,id',
            'image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif',
            'description' => 'required|string',
         //   'originalPrice' => 'required|numeric|regex:/^(\d+(?:[\.\,]\d{1,2})?)$/',
       //     'discountPrice' => 'required|numeric|regex:/^(\d+(?:[\.\,]\d{1,2})?)$/',
         //   'weight' => 'required|numeric|regex:/^(\d+(?:[\.\,]\d{1,3})?)$/',
        //    'stock' => 'required|numeric',
        //    'stock_alert' => 'required|numeric',
           // 'user_id'=>Auth::user(),
          //  'user_id' => auth()->user()->id,
          //  'image' => 'required|image|max:1024|mimes:jpg,jpeg,png',
            'category_id' => 'exists:categories,id',
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
