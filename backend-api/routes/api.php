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
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\Lang\LangController;
use App\Http\Controllers\MoneyController;
use App\Models\Serie;

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
// Route::get('/lang', [LangController::class, 'lang'])->middleware('localization');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
// Route::get('/return', function () {
//     $text = "A001-A654,B001-B999,C001-C999,D001-D999,E001-E999,A001-A733,B001-B999,C001-C999,D001-D999,E001-E999,A001-A746,B001-B999,C001-C999,D001-D999,E001-E999,A001-A772,B001-B999,C001-C999,D001-D999,E001-E999,A001-A631,B001-B999,C001-C999,D001-D999,E001-E999,F001-F999,A001-A161,B001-B999,C001-C999,D001-D999,E001-E999";
//     $imploded = explode(",", $text);
//     foreach ($imploded as $item) {
//         $data = Serie::where('title', $item)->first();
//         if (!$data) {
//             Serie::create([
//                 'title' => $item,
//                 'status' => '1',
//             ]);
//         }
//     }
// });
Route::middleware(['auth:api'])->group(function () {
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });

    //Index routes
    Route::post('/getlastcollected', [CollectionController::class, 'getLastCollected']);


    Route::get('getdata', [MoneyController::class, 'getdata']);
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::post('/updatepp', [ProfileController::class, 'updatepp']);
    Route::post('/updateprofile', [ProfileController::class, 'updateProfile']);
    Route::post('/getuser', [ProfileController::class, 'getUser']);
    Route::post('/changepassword', [ProfileController::class, 'changePassword']);

    //Profile Statics
    Route::get('/getstatics', [ProfileController::class, 'getStatics']);
    Route::get('/timeline', [ProfileController::class, 'getTimeline']);

    //Money routes
    Route::post('/moneys/get', [MoneyController::class, 'get']);
    Route::post('/moneyfilter', [MoneyController::class, 'getFilters']);
    Route::post('/getcatalog', [MoneyController::class, 'catalog']);
    //Get selected money
    Route::get('/money/{id}/get', [MoneyController::class, 'getMoney']);

    //Collection
    Route::get('/money/{id}/mycollection', [CollectionController::class, 'get']);
    Route::post('/collection/add', [CollectionController::class, 'add']);
    Route::post('/collection/delete', [CollectionController::class, 'delete']);
    Route::get('/mycollection/{id}/get', [CollectionController::class, 'getCollection']);
    Route::post('/deletecollectionimage', [CollectionController::class, 'deleteImg']);
    Route::post('/updatecollection', [CollectionController::class, 'update']);


    //admin routes
    Route::middleware(['isAdmin'])->group(function () {
        //Admin user
        Route::get('/user/get', [UserController::class, 'getUsers']);
        Route::post('/user/add', [UserController::class, 'addUser']);
        Route::get('/user/{id}/get', [UserController::class, 'getUser']);
        Route::post('/user/{id}/update', [UserController::class, 'updateUser']);
        Route::delete('/user/{id}/delete', [UserController::class, 'delete']);

        //Admin Money opr.

        //Emission
        Route::apiResource('/emission', EmissionController::class);
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
        //Admin money
        Route::post('/money/add', [MoneyController::class, 'add']);
        Route::delete('/money/{id}/delete', [MoneyController::class, 'delete']);
        Route::post('/money/{id}/update', [MoneyController::class, 'update']);
    });
});
