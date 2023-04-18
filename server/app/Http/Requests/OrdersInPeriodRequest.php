<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrdersInPeriodRequest extends FormRequest
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
            'startDate' => 'required|date|before_or_equal:' . Date('Y-m-d'),
            'endDate' => 'required|date|after_or_equal:startDate|before_or_equal:' . Date('Y-m-d'),
        ];
    }

    public function messages(): array
    {
        return [
            'startDate.*' => 'Enter correct date in first input field, it must be less or equal than today',
            'endDate.*' => 'Enter correct date in second input field, it must be less than the first and less or equal than today',
        ];
    }
}
