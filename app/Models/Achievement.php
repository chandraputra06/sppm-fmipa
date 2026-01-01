<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Achievement extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'date' => 'date',
    ];

    public function getJenisPrestasiAttribute()
    {
        return match ($this->category) {
            '1' => 'Akademik',
            '2' => 'Non Akademik',
            default => 'Unknown',
        };
    }

    // Prestasi milik satu Mahasiswa (opsional, bisa null)
    public function students(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    // Prestasi punya banyak komentar
    public function komentar(): HasMany
    {
        return $this->hasMany(Comment::class, 'id_prestasi', 'id_prestasi');
    }
}
