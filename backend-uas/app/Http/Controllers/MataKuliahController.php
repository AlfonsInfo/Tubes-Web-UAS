<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah; /* import model spama */
use Illuminate\Http\Request;
use App\Http\Resources\MataKuliahResource;
use Illuminate\Support\Facades\Validator;

class MataKuliahController extends Controller
{
    /**
    * index
    *
    * @return void
    */
    public function index()
    {
        //get MataKuliah
        $matkul = MataKuliah::latest()->get();
        //render view with MataKuliah
        return new MataKuliahResource(true, 'List Data Mata Kuliah', $matkul);
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
            'nama_matkul' => 'required',
            'kode_matkul' => 'required',
            'sks' => 'required|numeric',
            'kelas' => 'required',
            'dosen' => 'required',
            'sesi' => 'required'        
        ]);
            
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        //Fungsi Spama ke Database
        $matkul = MataKuliah::create([
            'nama_matkul' => $request->nama_matkul,
            'kode_matkul' => $request->kode_matkul,
            'sks' => $request->sks,
            'kelas' => $request->kelas,
            'dosen' => $request->dosen,
            'sesi' => $request->sesi
        ]);
        return new MataKuliahResource(true, 'Data Mata Kuliah Berhasil Ditambahkan!', $matkul);
    }

    public function destroy($id_matkul)
    {
        $matkul = MataKuliah::find($id_matkul);

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

    public function edit($id_matkul)
    {
        $matkul = MataKuliah::find($id_matkul);
        return view('matkul.edit', ['old' => $matkul]);  // -> resources/views/stocks/edit.blade.php
    }

    public function show($id_matkul)
    {
        $matkul = MataKuliah::find($id_matkul);
        return new MataKuliahResource(true, 'List Data MataKuliah', $matkul);
    }

    // public function showbyId($id)
    // {
    //     $user = Mat::find($id);
    //     return response([
    //         'message' => 'Retrieve Product Success',
    //         'data' => $user

    //     ],200);

    //     return response([
    //         'message' => 'Product Not Found',
    //         'data' => null
    //     ],404);
    // }
 
    public function update(Request $request, $id_matkul)
    {   
        $request->validate([
            'nama_matkul' => 'required',
            'kode_matkul' => 'required',
            'sks' => 'required|numeric',
            'kelas' => 'required',
            'dosen' => 'required',
            'sesi' => 'required'
        ]);
        
        $temp = MataKuliah::find($id_matkul);

        $temp->update([
            'nama_matkul' => $request->nama_matkul,
            'kode_matkul' => $request->kode_matkul,
            'sks' => $request->sks,
            'kelas' => $request->kelas,
            'dosen' => $request->dosen,
            'sesi' => $request->sesi
        ]);    

        return response()->json([
            'success' => true,
            'message' => 'MataKuliah Updated',
            'data'    => $temp  
        ], 200);
        // return redirect()->route('departemen.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
}
