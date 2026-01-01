<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->whereNull('deleted_at'),
            ],

            'role' => ['required', Rule::in([1, 2, 3])],

            'study_program_id' => [
                Rule::requiredIf(fn() => in_array($this->role, [2, 3])),
                'nullable',
                'exists:study_programs,id',
            ],

            'nim' => [
                Rule::requiredIf(fn() => $this->role == 3),
                'nullable',
                'string',
                Rule::unique('students', 'nim')->whereNull('deleted_at'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'study_program_id.required' => 'Study program wajib diisi',
            'nim.required' => 'NIM wajib diisi untuk student',
        ];
    }
}
