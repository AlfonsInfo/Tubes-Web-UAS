<?php

namespace App\Http\Controllers;

/* Import Model */

use App\Models\Spama; /* import model spama */
use Illuminate\Http\Request;
use App\Http\Resources\SpamaResource;
use Illuminate\Support\Facades\Validator;


class SpamaController extends Controller
{
    /**
    * index
    *
    * @return void
    */
    public function index()
    {
        //get spama
        $spama = Spama::latest()->get();
        //render view with spamas
        return new SpamaResource(true, 'List Data Spama',
        $spama);
    }

    /**
    * create
    *
    * @return void
    */
    public function create()
    {
        return view('spama.create');
    }


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
            'nama_kegiatan' => 'required',
            'penyelenggara' => 'required',
            'deskripsi_kegiatan' => 'required',
            'tanggal' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            //Fungsi Spama ke Database
            $spama = Spama::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'penyelenggara' => $request->penyelenggara,
            'deskripsi_kegiatan' => $request->deskripsi_kegiatan,
            'tanggal' => $request->tanggal
            ]);
            return new SpamaResource(true, 'Data Spama
            Berhasil Ditambahkan!', $spama);
    }

    public function destroy($id_spama)
    {
        $spama = Spama::findOrfail($id_spama);

        if($spama){
            //delete spama
            $spama->delete();

            return response()->json([
                'success' => true,
                'message' => 'Spama Deleted',
            ], 200);
        }

        //data spama not found
        return response()->json([
            'success' => false,
            'message' => 'Spama Not Found',
        ], 404);
    
    }

    public function edit($id_spama)
    {
        $spama = Spama::find($id_spama);
        return view('spama.edit', ['old' => $spama]);  // -> resources/views/stocks/edit.blade.php
    }

    public function show($id_spama)
    {
        $spama = Spama::find($id_spama);
        return new SpamaResource(true, 'List Data Spama', $spama);
    }
 
    public function update(Request $request, $id_spama)
    {   
        //set validation
        $request->validate([
            'nama_kegiatan'   => 'required',
            'penyelenggara' => 'required',
            'deskripsi_kegiatan' => 'required',
            'tanggal' => 'required'
        ]);

        $temp = Spama::find($id_spama);

        $temp->update([
            'nama_kegiatan'     => $request->nama_kegiatan,
            'penyelenggara'   => $request->penyelenggara,
            'deskripsi_kegiatan'   => $request->deskripsi_kegiatan,
            'tanggal'   => $request->tanggal
        ]);    

        return response()->json([
            'success' => true,
            'message' => 'SpamaUpdated',
            'data'    => $temp  
        ], 200);

        // //response error validation
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 400);
        // }

        // //find Spama by ID
        // $spama = Spama::findOrFail($spama->id_spama);

        // if($spama) {

        //     //update spama
        //     $spama->update([
        //         'nama_kegiatan'     => $request->nama_kegiatan,
        //         'penyelenggara'   => $request->penyelenggara,
        //         'deskripsi_kegiatan'   => $request->deskripsi_kegiatan,
        //         'tanggal'   => $request->tanggal
        //     ]);

        //     return response()->json([
        //         'success' => true,
        //         'message' => 'Spama Updated',
        //         'data'    => $spama  
        //     ], 200);

        // }

        // //data spama not found
        // return response()->json([
        //     'success' => false,
        //     'message' => 'Spama Not Found',
        // ], 404);

    }
    
    
    
}
