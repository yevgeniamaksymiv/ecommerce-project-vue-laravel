<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'sometimes|required|string|min:3|max:100',
            'description' => 'nullable|string|min:3|max:1000',
            'price' => 'sometimes|required|integer|digits_between:1,10',
            'quantity' => 'nullable|integer|digits_between:1,10',
            'size' => 'sometimes|required|integer|digits_between:1,10',
            'color' => 'nullable|string|min:3|max:50',
            'img_path' => 'nullable|image',
            'category_id' => 'nullable|integer|exists:App\Models\Category,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.*' => 'Field name is required, minimum length 3 characters,  maximum 100',
            'description.*' => 'Minimum length of description 3 characters, maximum 1000 ',
            'price.*' => 'Field price is required and must be an integer, 10 digits max',
            'quantity.*' => 'Field quantity must be an integer, 10 digits max',
            'size.*' => 'Field size is required and must be an integer, 10 digits max',
            'color.*' => 'Field color must be a string, minimum length 3 characters,  maximum 50',
            'img_path.*' => 'Image must be a file jpeg, png, jpg, gif, svg',
            'category_id.*' => 'Field category must be an integer',
        ];
    }
}
