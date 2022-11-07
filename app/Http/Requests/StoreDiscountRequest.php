<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiscountRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => ['required', 'unique:discounts,name'],
            'percentage' => ['required', 'integer'],
            'products_id' => [ 'array'],
            'products_id.*' => ['required', 'exists:products,id']
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => ':attribute é obrigatório',
            '*.unique' => ':attribute já existe',
            'products_id.*.not_in' => 'um elemento de products_id já pertence a um desconto',
            'products_id.*.exists' => 'um elemento de products_id não é um produto registrado'
        ];
    }
}
