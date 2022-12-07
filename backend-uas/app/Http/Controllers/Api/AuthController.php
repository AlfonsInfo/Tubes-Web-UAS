<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Resources\UserResource;
class AuthController extends Controller
{

    public function index()
    {
        
    }
    //REGISTER
    public function register(Request $request)
    {
        //Tampung Data dari Request(Seluruh Data inputan ) ke dalam variabel
        $registrationData = $request->all();

        //Lakukan validasi data
        $validate = Validator::make($registrationData, [
            //rule
        ]);

        //Aksi Jika Validasi Gagal
        if($validate->fails())
        {
            return response()->json($validate->errors(), 422);
        }

        //Enkripsi Password
        $registrationData['password'] = bcrypt($request->password);
        //Buat instance User disimpan dalam variabel $user
        $user = User::create($registrationData);

        //Code untuk verifikasi email
        //Returnnya ?
        // return UserResource / return response ?
        return new UserResource(true, 'Data User berhasil didaftarkan', $user);
    }



    //LOGIN
    public function login(Request $request)
    {
        //Menampung semua data dari form login
        $loginData = $request->all();

        //melakukan validasi data
        $validate = Validator::make($loginData,[
            'email' => 'required|email:rfc,dns',
            'password' => 'required'
        ]);

        //jika validasi gagal

        //jika attempt tidak dilakukan


        $user = Auth::user();
        //Generate token
        $token = $user->createToken('Authentication Token')->accessToken;
        
        //return classResource atau response
    }
}
