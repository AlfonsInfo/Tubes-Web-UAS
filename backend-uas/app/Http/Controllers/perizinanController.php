<?php

namespace App\Http\Controllers;

use App\Models\perizinan; /* import model spama */
use Illuminate\Http\Request;
use App\Http\Resources\perizinanResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class perizinanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         //get MataKuliah
         $perizinan = perizinan::latest()->get();
         //render view with MataKuliah
         return new perizinanResource(true, 'List Data Perizinan', $perizinan);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            "tanggal_izin"=> 'required',
            "tanggal_selesai"=> 'required|after:tanggal_izin',
            "tipe"=> 'required',
            "pesan"=> 'required',
            "status_perizinan"=> 'required',    
        ]);
            
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        //Fungsi Spama ke Database
        $perizinan = perizinan::create([
            'tanggal_izin' => $request->tanggal_izin,
            'tanggal_selesai' => $request->tanggal_selesai,
            'tipe' => $request->tipe,
            'pesan' => $request->pesan,    
            'id_user' => $request->id_user, 
            'status_perizinan' => $request->status_perizinan,
        ]);
        return new perizinanResource(true, 'Data Perizinan Berhasil Ditambahkan!', $perizinan);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $idUser = Auth::user()->id;
        $perizinan = DB::select("SELECT * FROM perizinans WHERE perizinans.id_user = '$idUser'");
        return new perizinanResource(true, 'List Data Perizinan', $perizinan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [
            "tanggal_izin"=> 'required',
            "tanggal_selesai"=> 'required|after:tanggal_izin',
            "tipe"=> 'required',
            "pesan"=> 'required', 
            "status_perizinan"=> 'required', 
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $temp = perizinan::find($id);

        $temp->update([
            "tanggal_izin"=> $request->tanggal_izin,
            "tanggal_selesai"=> $request->tanggal_selesai,
            "tipe"=> $request->tipe,
            "pesan"=> $request->pesan, 
            'status_perizinan' => $request->status_perizinan,
        ]);    

        return response()->json([
            'success' => true,
            'message' => 'Perizinan Updated',
            'data'    => $temp  
        ], 200);
        // return redirect()->route('departemen.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $perizinan = perizinan::find($id);

        if($perizinan){
            //delete spama
            $perizinan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Perizinan Deleted',
            ], 200);
        }else{
            //data spama not found
            return response()->json([
                'success' => false,
                'message' => 'Perizinan Not Found',
            ], 404);
        }    
    }
}
//