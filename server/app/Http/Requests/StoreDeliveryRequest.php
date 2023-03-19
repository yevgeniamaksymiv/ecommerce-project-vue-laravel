<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeliveryRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Field name is required',
            'name.min' => 'Minimum length of name 3 characters ',
            'name.max' => 'Maximum length of name 100 characters ',
        ];
    }
}
