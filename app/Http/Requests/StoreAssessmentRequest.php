<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAssessmentRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'visit_id' => 'required|exists:visits,id',
            'chief_complaint' => 'required',
            'blood_pressure' => 'required',
            'temperature' => 'required|numeric',
            'weight' => 'required|numeric',
            'initial_diagnosis' => 'required',
            'therapy' => 'required'
        ];
    }
}
