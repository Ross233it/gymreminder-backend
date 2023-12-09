<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SelectExerciseDetails extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'session_id' => ['required','integer', 'min:0', 'max:100000'],
            'schedule_id' => ['required','integer', 'min:0', 'max:100000'],
            'exercise_id' => ['required','integer', 'min:0', 'max:100000'],
        ];
    }
}
