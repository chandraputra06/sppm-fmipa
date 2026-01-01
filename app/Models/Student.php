<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }

    public function studyProgram(): BelongsTo
    {
        return $this->belongsTo(StudyProgram::class, 'study_program_id', 'id');
    }


    protected static function booted()
    {
        static::deleting(function ($student) {
            foreach ($student->achievements as $achievement) {
                // hapus file jika ada
                if ($achievement->proof) {
                    Storage::disk('public')->delete($achievement->proof);
                }

                if ($achievement->photo) {
                    Storage::disk('public')->delete($achievement->photo);
                }

                $achievement->delete();
            }
        });
    }
}
