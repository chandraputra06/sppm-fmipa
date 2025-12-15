<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Achievement extends Model
{
    use HasFactory;

    protected $table = 'prestasi';
    protected $primaryKey = 'id_prestasi';

    protected $fillable = [
        'nim_mahasiswa',
        'nama_mahasiswa',
        'program_studi',
        'judul_kegiatan',
        'jenis_prestasi',
        'tingkat',
        'tanggal_kegiatan',
        'file_bukti',
        'file_foto',
        'deskripsi',
        'status_publikasi',
    ];

    // Prestasi milik satu Mahasiswa (opsional, bisa null)
    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'nim_mahasiswa', 'nim');
    }

    // Prestasi punya banyak komentar
    public function komentar(): HasMany
    {
        return $this->hasMany(Comment::class, 'id_prestasi', 'id_prestasi');
    }
}
