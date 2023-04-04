<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'filters.price' => 'nullable',
            'filters.size' => 'nullable',
            'filters.color' => 'nullable',
            'filters.category_id' => 'nullable',
            'sorters.field' => 'nullable',
            'sorters.direction' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'filters.price' => 'Field price must be a string',
            'filters.size' => 'Field size must be a string',
            'filters.color' => 'Field color must be a string',
        ];
    }
}

