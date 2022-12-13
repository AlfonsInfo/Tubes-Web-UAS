<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');
// ->middleware('verified');
// ->middleware('verified');
Route::get('/email-verification', 'Api\VerificationController@verify')->name('verification.verify');

//Tambahin verified ?
Route::group(['middleware' => 'auth:api'], function(){
    Route::apiResource('/spamas', App\Http\Controllers\SpamaController::class);    
});

Route::apiResource('/matkuls', App\Http\Controllers\MataKuliahController::class);
Route::apiResource('/perizinans', App\Http\Controllers\perizinanController::class);


// Auth::routes(['verify' =>true]);

// Route::get('/verified-middleware-example', function()
// {
//     return response()->json([
//         'message' => 'the email account is already confirmed now you are able to use this web'
//     ]);
// })->middleware('verified');
