<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function userRole()
    {
        return match ($this->role) {
            '1' => [
                'label' => 'Admin',
                'bg'    => 'bg-gray-100',
                'text'  => 'text-gray-700',
            ],
            '2' => [
                'label' => 'Dosen',
                'bg'    => 'bg-blue-100',
                'text'  => 'text-blue-700',
            ],
            '3' => [
                'label' => 'Mahasiswa',
                'bg'    => 'bg-green-100',
                'text'  => 'text-green-700',
            ],
            default => [
                'label' => 'Unknown',
                'bg'    => 'bg-red-100',
                'text'  => 'text-red-700',
            ],
        };
    }

    public function lecture()
    {
        return $this->hasOne(Lecture::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }
}
