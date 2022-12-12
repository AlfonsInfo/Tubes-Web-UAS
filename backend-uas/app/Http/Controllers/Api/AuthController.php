<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Auth\Events\Registered;
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

        $user->sendEmailVerificationNotification();

        //Code untuk verifikasi email
        // event(new Registered($user));
        //Returnnya ?
        // return UserResource / return response ?
        
        //Tokennya belum ada 
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
        if($validate->fails())
            return response(['message' => $validate->errors()],400);
        //jika attempt tidak dilakukan
        if(!Auth::attempt($loginData))
            return response(['message' => "invalid credentials"],400);
        $user = Auth::user();
        // $user = Auth::find(Auth::user()['npm']) ;
        // dd($user);
        //Generate token
        $token = $user->createToken('Authentication Token')->accessToken;
        
        // return response([
        //     'message' => 'Authenticated',
        //     'user' => $user,
        //     'token_type' => 'Bearer',
        //     'access_token' => $token,
            
        // ]);

        $respons = response([
            'message' => 'Authenticated',
            'user' => $user,
            'token_type' => 'Bearer',
            'access_token' => $token,
        ]);

        // return $respons;

        return new UserResource(true, 'User berhasil login', $respons);
        //return classResource atau response
    }

    public function resend(Request $request)
    {
        if($request->user()->hasVerifiedEmail())
        {
            return redirect($this->redirectPath());
        }
    }
}
