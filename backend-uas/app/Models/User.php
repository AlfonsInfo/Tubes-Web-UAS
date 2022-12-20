<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;
use Carbon\Carbon;
use Illuminate\Auth\Notifications\VerifyEmail;

use App\Notifications\VerifyNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    //Mendefinisikan variable yang dapat diisi - Mass Assignment
    protected $fillable = [
        'npm',
        'nama',
        'email',
        'password',
        'status',
        'role',
        'jumlah_sks',
        // Tambahan
        'TTL',
        'alamat',
        'asal_sma',
        'agama',
        'nama_orang_tua'

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Untuk konversi valuedatetime pada created_at dan update_at
    public function getCreatedAtAttribute()
    {
        if(!is_null($this->attributes['created_at']))
        {
            return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i:s');
        }
    }
    
    public function getUpdateAtAttribute()
    {
        if(!is_null($this->attributes['update_']))
        {
            return Carbon::parse($this->attributes['update_at'])->format('Y-m-d H:i:s');
        }
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyNotification());
    }

    //Ngehubungkan ke Model/Table lain

    // public function perijinan()
    // {
    //     return $this->hasMay(Perijinan:class);
    // }

    public function spama(){
        return $this->hasMany(spama::class);
    }

    // public function pengambilanMatkul()
    // {
    //     return $this->hasMany(pengambilanMatkul::class)
    // }

    public function pengambilan_matkuls(){
        return $this->hasMany(PengambilanMatakuliah::class, 'id_mahasiswa', 'id');
    }
}
