<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGroupRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'name' => ['sometimes', 'required', 'unique:groups,name'],
            'cities_id' => ['array'],
            'cities_id.*' => ['sometimes', 'exists:cities,id'],
            'campaign_id' => ['sometimes', 'required', 'exists:campaigns,id']
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => ':attribute é obrigatório',
            '*.unique' => ':attribute já existe',
            '*.array' => ':attribute deve ser uma lista de ids de cidade',
            'cities_id.*.exists' => 'um elemento de cities_id não é uma cidade registrada',
            'campaign_id.exists' => ':attribute não é uma campanha resgitrada'
        ];
    }
}
