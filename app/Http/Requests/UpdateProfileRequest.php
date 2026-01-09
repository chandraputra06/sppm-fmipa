<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() && $this->route('user') && $this->user()->id === $this->route('user')->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = $this->route('user');

        return [
            'name'  => ['required', 'string', 'max:100'],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user?->id)->whereNull('deleted_at'),
            ],
            'study_program_id' => [
                'nullable',
                'exists:study_programs,id',
                Rule::requiredIf(fn () => in_array($user?->role, [2, 3])),
            ],
            'nim' => [
                'nullable',
                'string',
                'max:20',
                Rule::requiredIf(fn () => $user?->role == 3),
                Rule::unique('students', 'nim')->ignore(optional($user?->student)->id)->whereNull('deleted_at'),
            ],
        ];
    }
}
