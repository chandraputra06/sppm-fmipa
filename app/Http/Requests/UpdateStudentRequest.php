<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
            'nim'=>"sometimes|required|string|unique:students,nim,{$this->student->id},id",
            'name'=>'sometimes|required|string',
            'study_program_id'=>'sometimes|required|exists:study_programs,id',
            'user_id'=>'sometimes|required|exists:users,id',
        ];
    }
}
