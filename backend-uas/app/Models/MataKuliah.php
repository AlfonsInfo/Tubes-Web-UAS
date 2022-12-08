<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_matkul',    
        'kode_matkul',
        'sks',
        'kelas',
        'dosen',
        'sesi',
    ];        

    public function pengambilan_matkuls(){
        return $this->hasMany(PengambilanMatakuliah::class, 'id_matkul', id);
    }
}
