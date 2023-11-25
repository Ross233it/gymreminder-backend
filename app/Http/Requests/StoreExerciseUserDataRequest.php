<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreExerciseUserDataRequest extends FormRequest
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
            'user_id' => Auth::id(),
            'data' => Carbon::now(),
            'session_id'=>['required','integer', 'min:0', 'max:100000'],
            'series'=>['required','integer', 'min:0', 'max:100'],
            'repetitions'=>['required','integer', 'min:0', 'max:100'],
            'weight'=>['required','integer', 'min:0', 'max:500'],
        ];
    }
}
