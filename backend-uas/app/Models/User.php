<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'npm',
        'nama',
        'email',
        'password',
        'status',
        'role',
        'jumlah_sks'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function perijinan()
    // {
    //     return $this->hasMay(Perijinan:class);
    // }

    // public function spama(){
    //     return $this->hasMany(spama::class)
    // }

    // public function pengambilanMatkul()
    // {
    //     return $this->hasMany(pengambilanMatkul::class)
    // }

}
