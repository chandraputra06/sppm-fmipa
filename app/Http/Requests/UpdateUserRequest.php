<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name'  => ['required', 'string', 'max:100'],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->user->id)->whereNull('deleted_at'),
            ],
            'role' => ['required', Rule::in([1, 2, 3])],

            'study_program_id' => [
                'nullable',
                'exists:study_programs,id',
                Rule::requiredIf(fn() => in_array($this->role, [2, 3])),
            ],

            'nim' => [
                'nullable',
                'string',
                'max:20',
                Rule::requiredIf(fn() => $this->role == 3),
                Rule::unique('students', 'nim')->whereNull('deleted_at')->ignore(optional($this->user->student)->id),
            ],
        ];
    }
}