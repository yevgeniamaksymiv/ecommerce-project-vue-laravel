<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SortProductRequest extends FormRequest
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
            'price' => 'nullable|string',
            'created_at' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'price.*' => 'Field price must be a string',
            'created_at.*' => 'Field date must be a string',
        ];
    }
}

