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
            'price' => 'sometimes',
            'size' => 'sometimes',
            'color' => 'sometimes',
        ];
    }

    public function messages(): array
    {
        return [
            'price' => 'Field price is required and must be a string',
            'size' => 'Field size is required and must be a string',
            'color' => 'Field color must be a string',
        ];
    }
}

