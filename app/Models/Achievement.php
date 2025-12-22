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

    protected $table = 'prestasi';
    protected $primaryKey = 'id_prestasi';

    protected $guarded = []; 

    // Prestasi milik satu Mahasiswa (opsional, bisa null)
    public function students(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    // Prestasi punya banyak komentar
    public function komentar(): HasMany
    {
        return $this->hasMany(Comment::class, 'id_prestasi', 'id_prestasi');
    }
}
