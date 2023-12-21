<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSessionRequest extends FormRequest
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
            'id' =>  ['nullable' ,'integer', 'min:0', 'max:100000'],
            'name' =>['required', 'string', 'max:30',
                Rule::unique('gym_sessions', 'name')
                    ->ignore($this->route('sessionId'))],
            'description'=>['required','string', 'max:255'],
        ];
    }
}
