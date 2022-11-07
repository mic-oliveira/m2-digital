<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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

    public function rules(): array
    {
        return [
            'name' => ['required', 'unique:products,name'],
            'description' => ['sometimes', 'required'],
            'price' => ['required', 'numeric'],
            'discount_id' => ['sometimes', 'required', 'exists:discounts,id']
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => ':attribute é obrigatório',
            '*.unique' => ':attribute deve ser único',
            '*.numeric' => ':attribute dever ser um número',
            '*.exists' => 'O :attribute informado não está registrado'
        ];
    }
}
