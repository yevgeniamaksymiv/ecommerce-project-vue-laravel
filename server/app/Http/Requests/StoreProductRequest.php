<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'sometimes|required|string|min:3|max:255',
            'description' => 'nullable|string|min:3|max:1000',
            'price' => 'sometimes|required|integer',
            'quantity' => 'nullable|integer',
            'size' => 'sometimes|required|integer',
            'color' => 'nullable|string',
            'img_path' => 'nullable|image',
            'category_id' => 'nullable|integer|exists:App\Models\Category,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.*' => 'Field name is required, minimum length 3 characters',
            'description.*' => 'Minimum length of description 3 characters, maximum 1000 ',
            'price.*' => 'Field price is required and must be an integer',
            'quantity.*' => 'Field quantity must be an integer',
            'size.*' => 'Field size is required and must be an integer',
            'color.*' => 'Field color must be a string',
            'img_path.*' => 'Image must be a file jpeg, png, jpg, gif, svg',
            'category_id.*' => 'Field category must be an integer',
        ];
    }
}
