<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
        $todayDate = date('Y-m-d');

        return [
            'order_date' => 'nullable|date_format:Y-m-d|date_equals:'.$todayDate,
            'delivery_address' => 'nullable|string|min:3|max:1000',
            'order_amount' => 'required|integer',
            'user_id' => 'nullable|integer|exists:App\Models\User,id',
            'delivery_id' => 'nullable|integer|exists:App\Models\Delivery,id',
        ];
    }

    public function messages(): array
    {
        return [
            'order_date.*' => 'Must be today\'s date',
            'delivery_address.*' => 'Minimum length of address 3 characters, maximum 1000 ',
            'order_amount.*' => 'Field amount is required and must be an integer',
            'user_id.*' => 'Field user id must be an integer',
            'delivery_id.*' => 'Field delivery id must be an integer',
        ];
    }
}
