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
use Laravel\Passport\HasApiTokens;;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token;

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
        if($user->email_verified_at == null){
            return response(['message' => "Your Accout Email must be verified before you can continue"],403);
        }
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

        // @dd($respons);

        // return $respons;

        return new UserResource(true, 'User berhasil login', $respons);
        //return classResource atau response
    }

    public function logout(Request $request)
    {
    // dd(Auth::user());    
    if(Auth::user()){
        $user = Auth::user()->token();
        
        $user->revoke();

        $tokens =  $user->id;
        Token::where('id', $tokens)->update(['revoked'=> true]);
        RefreshToken::where('access_token_id', $tokens)->update(['revoked' => true]);
        return response()->json([
            'success' => true,
            'message' => 'Logout successfully',
        ]);
        } else{
        return response()->json([
            'success' => false,
            'message' => 'Unable to Logout',
        ]);
        }
    }

    //untuk ditampilin di profile 
    public function show($id)
    {
        $user = User::find($id);
        return response([
            'message' => 'Retrieve Product Success',
            'data' => $user

        ],200);

        return response([
            'message' => 'Product Not Found',
            'data' => null
        ],404);
    }
    

    public function resend(Request $request)
    {
        if($request->user()->hasVerifiedEmail())
        {
            return redirect($this->redirectPath());
        }
    }

    public function update(Request $request, $id)
    {
        //Temukan data user yang ingin diupdate berdasarkan id
        $User = User::find($id);
        //cek data apakah ada, jika tidak ada return 'user not found'
        if(is_null($User))
        {
            return response([
                'message' => 'User Not Found',
                'data' => null
            ],404);
        }
        //Jika tidak , lanjutkan eksekusi code
        //kirimkan request data, validasi nilainya
        $updateData = $request->all();
        // dd($updateData);
        $validate = validator::make($updateData,[

        ]);
        //jika validasi gagal, return respons
        if($validate->fails())
                return response(['message' => $validate->errors()], 400);
        //jika tidak gagal lanjutan proses update
        // $uploadFolder = 'users';
        // $image = $request->file('image');
        // $image_uploaded_path = $image->store($uploadFolder, 'public');
        
        // $uploadedImageResponse = array(
        //     "image_name" => basename($image_uploaded_path),
        //     "image_url" => Storage::url($image_uploaded_path),
        //     "mime" => $image->getClientMimeType()
        // );
        $User->nama = $updateData['nama'];
        $User->email = $updateData['email'];
        // $User->password = bcrypt($updateData['password']);
        $User->TTL = $updateData['TTL'];       
        $User->alamat = $updateData['alamat'];       
        $User->asal_sma = $updateData['asal_sma'];       
        $User->agama = $updateData['agama'];       
        $User->nama_orang_tua = $updateData['nama_orang_tua'];       
        // $User->image = $updateData['image'];
        if($User->save())
        {
            return response([
                'message' => 'Update User Success',
                'data' => $User,
            ],200);
        }
        return response([
            'message' => 'Update User Failed',
            'data' => null
        ],400);
    }
}
