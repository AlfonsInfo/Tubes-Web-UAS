<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengambilanMatakuliah extends Model
{
    use HasFactory;

    protected $fillable = [      
        'id_mahasiswa',
        'id_matkul',
    ];

    public function matkuls(){
        return $this->belongsTo(Matakuliah::class, 'id_matkul');
    }

    public function mahasiswas(){
        return $this->belongsTo(User::class, 'id_mahasiswa');
    }
}
