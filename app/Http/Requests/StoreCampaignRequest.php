<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCampaignRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required | unique:campaigns,name',
            'status' => ['sometimes','required'],
            'groups_id' => ['sometimes', 'array'],
            'groups.*' => ['required', 'exists:groups,id'],
            'products_id' => ['sometimes', 'array'],
            'products_id.*' => ['required', 'exists:products,id']
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => ':attribute é obrigatório',
            '*.unique' => ':attribute já existe',
            '*.array' => ':attribute deve ser uma lista',
            'groups_id.exists' => 'um elemento de groups_id não é um grupo registrado',
            'products_id.*.exists' => 'um elemento de products_id não é um produto registrado'
        ];
    }

}
