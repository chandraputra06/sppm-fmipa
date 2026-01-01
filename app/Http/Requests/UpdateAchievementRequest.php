<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAchievementRequest extends FormRequest
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
            'title'       => 'required|string|max:200',
            'category'    => 'required|in:1,2',
            'grade'       => 'required|in:Lokal,Nasional,Internasional',
            'date'        => 'required|date',
            'description' => 'nullable|string',
            'status'      => 'required|in:Draft,Verified,Publish',
            'student_id'  => 'required|exists:students,id',

            // file OPTIONAL saat update
            'proof'       => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png|max:3072',
        ];
    }
}
