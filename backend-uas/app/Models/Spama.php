<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spama extends Model
{
    use HasFactory;
    /**
    * fillable
    *
    * @var array
    */
    protected $fillable = [
    'nama_kegiatan',
    'penyelenggara',
    'deskripsi_kegiatan',
    'tanggal',
    ]; 

    public function mahasiswas(){
        return $this->hasMany(Mahasiswa::class, 'npm', npm);
    }
}
