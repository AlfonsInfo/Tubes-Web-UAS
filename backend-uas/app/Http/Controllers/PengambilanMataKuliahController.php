<?php

namespace App\Http\Controllers;

use App\Models\PengambilanMataKuliah; /* import model spama */
use Illuminate\Http\Request;
use App\Http\Resources\PengambilanMataKuliahResource;
use Illuminate\Support\Facades\Validator;

class PengambilanMataKuliahController extends Controller
{
    /**
    * index
    *
    * @return void
    */
    public function index()
    {
        //get MataKuliah
        $matkul = PengambilanMataKuliah::latest()->with(['matkuls','mahasiswas'])->get();
        //render view with MataKuliah
        return new PengambilanMataKuliahResource(true, 'List Data Mata Kuliah', $matkul);
    }

    /**
    * create
    *
    * @return void
    */
    // public function create()
    // {
    //     return view('matkul.create');
    // }


    /**
    * store
    *
    * @param Request $request
    * @return void
    */
    public function store(Request $request)
    {
        //Validasi Formulir
        $validator = Validator::make($request->all(), [
            'id_matkul' => 'required',
            'id_mahasiswa' => 'required',      
        ]);
            
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        //Fungsi Spama ke Database
        $matkul = PengambilanMataKuliah::create([
            'id_matkul' => $request->id_matkul,
            'id_mahasiswa' => $request->id_mahasiswa,        
        ]);
        return new PengambilanMataKuliahResource(true, 'Data Mata Kuliah Berhasil Ditambahkan!', $matkul);
    }

    public function destroy($id_mahasiswa)
    {
        $matkul = PengambilanMataKuliah::find($id_mahasiswa);

        if($matkul){
            //delete spama
            $matkul->delete();

            return response()->json([
                'success' => true,
                'message' => 'Mata Kuliah Deleted',
            ], 200);
        }else{
            //data spama not found
            return response()->json([
                'success' => false,
                'message' => 'Mata Kuliah Not Found',
            ], 404);
        }        
    
    }

    public function edit($id_mahasiswa)
    {
        $matkul = PengambilanMataKuliah::find($id_mahasiswa);
        return view('matkul.edit', ['old' => $matkul]);  // -> resources/views/stocks/edit.blade.php
    }

    public function show($id_mahasiswa)
    {
        $matkul = PengambilanMataKuliah::find($id_mahasiswa);
        return new PengambilanMataKuliahResource(true, 'List Data MataKuliah', $matkul);
    }
 
    public function update(Request $request, $id_mahasiswa)
    {   
        $request->validate([
            'id_matkul' => 'required',
            'id_mahasiswa' => 'required',
        ]);
        
        $temp = PengambilanMataKuliah::find($id_mahasiswa);

        $temp->update([
            'id_matkul' => $request->id_matkul,
            'id_mahasiswa' => $request->id_mahasiswa,
        ]);    

        return response()->json([
            'success' => true,
            'message' => 'MataKuliah Updated',
            'data'    => $temp  
        ], 200);
        // return redirect()->route('departemen.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
}
