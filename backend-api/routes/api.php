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
use App\Models\Kuphur;
use App\Models\Money;
use App\Models\MoneySignatures;
use App\Models\PrintPlace;
use App\Models\Scwpm;
use App\Models\Serie;
use App\Models\Signature;
use App\Models\Tertip;

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
Route::get('/return', function () {
    $string = file_get_contents(base_path('routes/money.json'));
    foreach (json_decode($string, true) as $item) {
        $item['Taşıdığı İmzalar'] = explode(",", $item['Taşıdığı İmzalar']);
        $item['sign'] = [];
        if ($item['Tedavüle çıkarıldığı tarih']) {
            $date = strtotime($item['Tedavüle çıkarıldığı tarih']);
            $item['Tedavüle çıkarıldığı tarih'] = date('Y-m-d', $date);
        } else {
            $item['Tedavüle çıkarıldığı tarih'] = date('Y-m-d');
        }
        if ($item['Tedavülden çekildiği tarih']) {
            $date = strtotime($item['Tedavülden çekildiği tarih']);
            $item['Tedavülden çekildiği tarih'] = date('Y-m-d', $date);
        } else {
            $item['Tedavülden çekildiği tarih'] = date('Y-m-d');
        }
        if ($item['Zorunlu tedavül süresinin sonu']) {
            $date = strtotime($item['Zorunlu tedavül süresinin sonu']);
            $item['Zorunlu tedavül süresinin sonu'] = date('Y-m-d', $date);
        } else {
            $item['Zorunlu tedavül süresinin sonu'] = date('Y-m-d');
        }
        if ($item['Zaman aşımı süresinin sonu']) {
            $date = strtotime($item['Tedavüle çıkarıldığı tarih']);
            $item['Zaman aşımı süresinin sonu'] = date('Y-m-d', $date);
        } else {
            $item['Zaman aşımı süresinin sonu'] = date('Y-m-d');
        }
        if ($item['Kıymetini tamamen kaybedeceği tarih']) {
            $date = strtotime($item['Kıymetini tamamen kaybedeceği tarih']);
            $item['Kıymetini tamamen kaybedeceği tarih'] = date('Y-m-d', $date);
        } else {
            $item['Kıymetini tamamen kaybedeceği tarih'] = date('Y-m-d');
        }
        $scwpm = Scwpm::where('title', $item['SCWPM / Pick #'])->select('id')->first();
        if (!$scwpm) {
            $scwpm = Scwpm::create([
                'title' => $item['SCWPM / Pick #'],
                'status' => '1',
            ]);
        }
        $kuphur = Kuphur::where('title', $item['Kupür'])->select('id')->first();
        if (!$kuphur) {
            $kuphur = Kuphur::create([
                'title' => $item['Kupür'],
                'status' => '1',
            ]);
        }
        $serie = Serie::where('title', $item[" İlk ve Son Seri"])->select('id')->first();
        if (!$serie) {
            $serie = Serie::create([
                'title' => $item[' İlk ve Son Seri'],
                'status' => '1',
            ]);
        }
        $tertip = Tertip::where('title', $item['Tertip'])->select('id')->first();
        if (!$tertip) {
            $tertip = Tertip::create([
                'title' => $item['Tertip'],
                'status' => '1',
            ]);
        }
        $printplace = PrintPlace::where('title', $item['Bastırıldığı yer'])->select('id')->first();
        if (!$printplace) {
            $printplace = PrintPlace::create([
                'title' => $item['Bastırıldığı yer'],
                'status' => '1',
            ]);
        }
        foreach ($item['Taşıdığı İmzalar'] as $sign) {
            $data = Signature::where('title', $sign)->select('id')->first();
            if (!$data) {
                $data = Signature::create([
                    'title' => $sign,
                    'status' => "1",
                ]);
                array_unshift($item['sign'], $data->id);
            } else {
                array_unshift($item['sign'], $data->id);
            }
        }
        $moneyData = Money::create([
            "emission_id" => "9",
            "scwpm_id" => $scwpm['id'],
            "kuphur_id" => $kuphur['id'],
            "value" => $item['Nominal'],
            "serie_id" => $serie['id'],
            "cilValue" => $item['ÇİL (UNC) 58+'],
            "ctValue" => $item['ÇT (XF) 30+'],
            "tValue" => $item['T (F) 15+'],
            "tertip_id" => $tertip['id'],
            "size" => $item['Boyutları'],
            "print_place_id" => $printplace['id'],
            "tedavulDate" => $item['Tedavüle çıkarıldığı tarih'],
            "lastDate" => $item['Tedavülden çekildiği tarih'],
            "zortedDate" => $item['Zorunlu tedavül süresinin sonu'],
            "timeoutDate" => $item['Zaman aşımı süresinin sonu'],
            "expiryDate" => $item['Kıymetini tamamen kaybedeceği tarih'],
            "frontColor" => "Zeytuni Yeşil",
            "backColor" => "Zeytuni Yeşil",
            "link" => $item['TCMB Detay Linki'],
            "desc" => "",
            "status" => "1",
            "frontImage" => "http://localhost:8000/public/MyFqFCYneLi0n6BgsFuBj6VqqKtkuJSQPIiCWzxo.jpg",
            "backImage" => "http://localhost:8000/public/MyFqFCYneLi0n6BgsFuBj6VqqKtkuJSQPIiCWzxo.jpg",
        ]);

        if ($moneyData) {
            foreach ($item['sign'] as $sign) {
                MoneySignatures::create([
                    "moneyId" => $moneyData->id,
                    "signatureId" => $sign,
                ]);
            }
        }
    }
});

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
