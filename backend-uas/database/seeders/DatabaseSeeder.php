<?php

namespace Database\Seeders;

use App\Models\perizinan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; 
use App\Models\Spama;
use App\Models\MataKuliah; 
use App\Models\PengambilanMatakuliah; 

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => '1',
            'npm' => '200710541',
            'email' => 'alvonsus.setiawan@gmail.com',
            'nama' => 'Alfonsus Setiawan Jacub',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ]);
        User::create([
            'id' => '5',
            'npm' => '200710541-',
            'email' => 'admin@gmail.com',
            'nama' => 'Alfonsus Setiawan Admin',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role' => '1'
        ]);
        User::create([
            'id' => '2',
            'npm' => '200710881',
            'email' => 'dapot@gmail.com',
            'nama' => 'dapot',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ]);

        User::create([
            'id' => '3',
            'npm' => '200710784',
            'email' => 'ariel@gmail.com',
            'nama' => 'ariel',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ]);

        User::create([
            'id' => '4',
            'npm' => '200710705',
            'email' => 'Hanwyn@gmail.com',
            'nama' => 'Hanwyn',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ]);
        // User::factory(10)->create();
        Spama::factory(10)->create();
        perizinan::factory(10)->create();

        Matakuliah::create([
            'kode_matkul' => 'INF231',
            'nama_matkul' => 'Pemrograman Website Tercintahh',
            'sks' => '3',
            'kelas' => 'A',
            'dosen' => "Pak Aga",
            'sesi' => "3",
        ]);

        Matakuliah::create([
            'kode_matkul' => 'INF233',
            'nama_matkul' => 'Pemrograman Berbasis Platform Mantep',
            'sks' => '4',
            'kelas' => 'A',
            'dosen' => "Pak Bryan",
            'sesi' => "4",
        ]);

        Matakuliah::create([
            'kode_matkul' => 'INF233',
            'nama_matkul' => 'Sistem Paralel',
            'sks' => '3',
            'kelas' => 'A',
            'dosen' => "Pak Pranowo",
            'sesi' => "4",
        ]);

        PengambilanMatakuliah::factory(5)->create();
    }
}
