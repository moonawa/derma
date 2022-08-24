<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('refresh', [AuthController::class, 'refresh']);

    //patients
    Route::post('store/patient', [PatientController::class, 'store']);
    Route::get('index/patient', [PatientController::class, 'index']);
    Route::get('show/patient/{id}', [PatientController::class, 'show']);

    //medecins
    Route::post('store/medecin', [MedecinController::class, 'store']);
    Route::get('index/medecin', [MedecinController::class, 'index']);
    Route::get('show/medecin/{id}', [MedecinController::class, 'show']);


    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('user', [AuthController::class, 'user']);
        Route::post('logout', [AuthController::class, 'logout']);
        //users
        Route::get('users', [UserController::class, 'index'])->middleware('CheckIsMedecin');
        Route::get('users/{id}', [UserController::class, 'show'])->middleware('CheckIsMedecinOrSelf');
    });
});



