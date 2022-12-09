<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perizinan extends Model
{
    use HasFactory;

    protected $fillable = [      
        "tanggal_izin",
        "tanggal_selesai",
        "tipe",
        "pesan",
        'id_user',
        'status_perizinan',
    ];

    public function npm(){
        return $this->belongsTo(User::class, 'id_user');
    }


}
