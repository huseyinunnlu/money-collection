<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EmissionController;
use App\Http\Controllers\Admin\SCWPMController;
use App\Http\Controllers\Admin\KuphurController;
use App\Http\Controllers\Admin\PrintPlaceController;
use App\Http\Controllers\Admin\TertipController;
use App\Http\Controllers\Admin\SerieController;
use App\Http\Controllers\Admin\SignatureController;
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

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

Route::middleware(['auth:api'])->group(function () {
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::post('/updatepp', [ProfileController::class, 'updatepp']);
    Route::post('/updateprofile', [ProfileController::class, 'updateProfile']);
    Route::post('/getuser', [ProfileController::class, 'getUser']);
    Route::post('/changepassword', [ProfileController::class, 'changePassword']);

    Route::middleware(['isAdmin'])->group(function () {
        //Admin user
        Route::get('/user/get', [UserController::class, 'getUsers']);
        Route::post('/user/add', [UserController::class, 'addUser']);
        Route::get('/user/{id}/get', [UserController::class, 'getUser']);
        Route::post('/user/{id}/update', [UserController::class, 'updateUser']);
        Route::delete('/user/{id}/delete', [UserController::class, 'delete']);

        //Admin Money opr.

        //Emission
        Route::get('/emission/get', [EmissionController::class, 'get']);
        Route::post('/emission/add', [EmissionController::class, 'add']);
        Route::get('/emission/{id}/get', [EmissionController::class, 'getEmission']);
        Route::post('/emission/{id}/update', [EmissionController::class, 'update']);
        Route::delete('/emission/{id}/delete', [EmissionController::class, 'delete']);

        //SCWPM
        Route::apiResource('/scwpm', SCWPMController::class);
        //Kuphur
        Route::apiResource('/kuphur', KuphurController::class);
        //Print place
        Route::apiResource('/printplace', PrintPlaceController::class);
        //tertip
        Route::apiResource('/tertip', TertipController::class);
        //serie
        Route::apiResource('/serie', SerieController::class);
        //signature
        Route::apiResource('/signature', SignatureController::class);



    });
});
