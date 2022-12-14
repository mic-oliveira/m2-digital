<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class StoreGroupRequest extends FormRequest
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
        $cities_id = DB::table('cities_groups')
            ->select('*')
            ->get()
            ->unique('city_id')
            ->pluck('city_id')->toArray();
        return [
            'name' => ['required','unique:groups,name'],
            'cities_id' => ['sometimes', 'array'],
            'cities_id.*' => ['sometimes',Rule::notIn($cities_id), 'exists:cities,id']
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => ':attribute é obrigatório',
            '*.unique' => ':attribute já existe',
            'cities_id.*.not_in' => 'um elemento de cities_id já pertence a um grupo',
            'cities_id.*.exists' => 'um elemento de cities_id não é uma cidade registrada'
        ];
    }
}
