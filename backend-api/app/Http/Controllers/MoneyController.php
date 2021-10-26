<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;

use App\Models\Emission;
use App\Models\Kuphur;
use App\Models\Money;
use App\Models\MoneySignatures;
use App\Models\PrintPlace;
use App\Models\Scwpm;
use App\Models\Serie;
use App\Models\Signature;
use App\Models\Tertip;
use Illuminate\Support\Facades\Auth;

class MoneyController extends Controller
{
    public function getdata()
    {
        $emission = Emission::where('status', '1')->select('id', 'title')->get();
        $scwpm = Scwpm::where('status', '1')->select('id', 'title')->get();
        $kuphur = Kuphur::where('status', '1')->select('id', 'title')->get();
        $serie = Serie::where('status', '1')->select('id', 'title')->get();
        $tertip = Tertip::where('status', '1')->select('id', 'title')->get();
        $printPlace = PrintPlace::where('status', '1')->select('id', 'title')->get();
        $signatures = Signature::where('status', '1')->select('id', 'title')->get();

        $data = [
            "emission" => $emission,
            "scwpm" => $scwpm,
            "kuphur" => $kuphur,
            "serie" => $serie,
            "tertip" => $tertip,
            "printPlace" => $printPlace,
            "signatures" => $signatures,
        ];

        return response()->json([
            "status" => "ok",
            "data" => $data,
        ], 200);
    }

    public function add(Request $request)
    {

        $request->validate([
            "emissionId" => "required",
            "scwpmId" => "required",
            "kuphurId" => "required",
            "value" => "required",
            "serieId" => "required",
            "cilValue" => "required",
            "ctValue" => "required",
            "tValue" => "required",
            "tertipId" => "required",
            "size" => "required",
            "printPlace" => "required",
            "signatures" => "required",
            "tedavulDate" => "required|date",
            "lastDate" => "required|date",
            "zortedDate" => "required|date",
            "timeoutDate" => "required|date",
            "expiryDate" => "required|date",
            "frontColor" => "required",
            "backColor" => "required",
            "link" => "required|url",
            "desc" => "nullable|max:255",
            "status" => "required",
            "frontImage" => "required|file|mimes:jpg,jpeg,png|max:2048",
            "backImage" => "required|file|mimes:jpg,jpeg,png|max:2048",
        ]);

        if ($request->hasFile('frontImage') && $request->hasFile('backImage')) {

            $key = '';
            $keys = array_merge(range('a', 'z'), range('A', 'Z'), range('0', '9'));
            for ($i = 0; $i <= 25; $i++) {
                $key .= $keys[array_rand($keys)];
            }
            $frontImageName = env('APP_URL') . "uploads/" . $key . $request->frontImage->getClientOriginalName();
            $request->frontImage->move(public_path('uploads'), $frontImageName);

            $key = '';
            $keys = array_merge(range('a', 'z'), range('A', 'Z'), range('0', '9'));
            for ($i = 0; $i <= 25; $i++) {
                $key .= $keys[array_rand($keys)];
            }
            $backImageName = env('APP_URL') . "uploads/" . $key . $request->backImage->getClientOriginalName();
            $request->backImage->move(public_path('uploads'), $backImageName);
        }

        $moneyData = Money::create([
            "emissionId" => $request->emissionId,
            "scwpmId" => $request->scwpmId,
            "kuphurId" => $request->kuphurId,
            "value" => $request->value,
            "serieId" => $request->serieId,
            "cilValue" => $request->cilValue,
            "ctValue" => $request->ctValue,
            "tValue" => $request->tValue,
            "tertipId" => $request->tertipId,
            "size" => $request->size,
            "printPlace" => $request->printPlace,
            "tedavulDate" => $request->tedavulDate,
            "lastDate" => $request->lastDate,
            "zortedDate" => $request->zortedDate,
            "timeoutDate" => $request->timeoutDate,
            "expiryDate" => $request->expiryDate,
            "frontColor" => $request->frontColor,
            "backColor" => $request->backColor,
            "link" => $request->link,
            "desc" => $request->desc,
            "status" => $request->status,
            "frontImage" => $frontImageName,
            "backImage" => $backImageName,
        ]);

        if ($moneyData) {
            $signatures = explode(",", $request->signatures);
            foreach ($signatures as $sign) {
                MoneySignatures::create([
                    "moneyId" => $moneyData->id,
                    "signatureId" => $sign,
                ]);
            }
            $data = Money::with('emission', 'scwpm', 'kuphur', 'serie', 'tertip', 'printPlace', 'signature.name')->latest()->first();
            return response()->json([
                "status" => "ok",
                "data" => $data,
            ], 200);
        }
        return response()->json([
            "status" => "false",
            "message" => "Money did't added",
        ], 500);
    }

    public function get(Request $request)
    {
        $collectedMoneys = [];
        if ($request->isCollected == 1) {
            $collected = Collection::where('userId', Auth::user()->id)->select('moneyId')->get();
            foreach ($collected as $coll) {
                array_push($collectedMoneys, $coll->moneyId);
            }
        }
        if ($request->emission && $request->scwpm && $request->kuphur && $request->serie && $request->tertip) {
            if ($request->isCollected == 1) {
                $data = Money::with('collection', 'emission', 'scwpm', 'kuphur', 'serie', 'tertip', 'printPlace', 'signature.name')
                    ->whereIn('id', $collectedMoneys)
                    ->where('emissionId', $request->emission)
                    ->where('scwpmId', $request->scwpm)
                    ->where('kuphurId', $request->kuphur)
                    ->where('serieId', $request->serie)
                    ->where('tertipId', $request->tertip)
                    ->where('status', $request->status)
                    ->orderBy('created_at', $request->sort)
                    ->paginate($request->count);
            } else {
                $data = Money::with('collection', 'emission', 'scwpm', 'kuphur', 'serie', 'tertip', 'printPlace', 'signature.name')
                    ->where('emissionId', $request->emission)
                    ->where('scwpmId', $request->scwpm)
                    ->where('kuphurId', $request->kuphur)
                    ->where('serieId', $request->serie)
                    ->where('tertipId', $request->tertip)
                    ->where('status', $request->status)
                    ->orderBy('created_at', $request->sort)
                    ->paginate($request->count);
            }
        } else {
            if ($request->isCollected == 1) {
                $data = Money::with('collection', 'emission', 'scwpm', 'kuphur', 'serie', 'tertip', 'printPlace', 'signature.name')
                    ->whereIn('id', $collectedMoneys)
                    ->where('status', $request->status)
                    ->orderBy('created_at', $request->sort)
                    ->paginate($request->count);
            } else {
                $data = Money::with('collection', 'emission', 'scwpm', 'kuphur', 'serie', 'tertip', 'printPlace', 'signature.name')
                    ->where('status', $request->status)
                    ->orderBy('created_at', $request->sort)
                    ->paginate($request->count);
            }
        }
        if ($data) {
            return response()->json([
                "status" => "ok",
                "data" => $data,
            ], 200);
        }
        return response()->json([
            "status" => "false",
            "message" => "Money not found",
        ], 500);
    }

    public function delete($id)
    {
        $data = Money::whereId($id)->delete();
        if ($data) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Money successfuly deleted',
            ], 200);
        }
        return response()->json([
            'status' => 'false',
            'message' => "Money didn't deleted",
        ], 500);
    }

    public function getMoney($id)
    {
        $data = Money::with('emission', 'scwpm', 'kuphur', 'serie', 'tertip', 'printPlace', 'signature.name')->whereId($id)->first();
        if ($data) {
            $signs = [];
            foreach ($data['signature'] as $sign) {
                array_unshift($signs, $sign['signatureId']);
            }
            $data['selectedSign'] = $signs;
            return response()->json([
                "status" => "ok",
                "data" => $data,
            ], 200);
        }
        return response()->json([
            "status" => "false",
            "message" => 'Money not found',
        ], 500);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "emissionId" => "required",
            "scwpmId" => "required",
            "kuphurId" => "required",
            "value" => "required",
            "serieId" => "required",
            "cilValue" => "required",
            "ctValue" => "required",
            "tValue" => "required",
            "tertipId" => "required",
            "size" => "required",
            "printPlace" => "required",
            "signatures" => "nullable",
            "tedavulDate" => "required|date",
            "lastDate" => "required|date",
            "zortedDate" => "required|date",
            "timeoutDate" => "required|date",
            "expiryDate" => "required|date",
            "frontColor" => "required",
            "backColor" => "required",
            "link" => "required|url",
            "desc" => "required|max:255",
            "status" => "required",
            // "backImage" => "required|file|mimes:jpg,jpeg,png|max:2048",
        ]);

        if ($request->hasFile('frontImage')) {
            $request->validate([
                "frontImage" => "required|file|mimes:jpg,jpeg,png|max:2048",
            ]);
            $key = '';
            $keys = array_merge(range('a', 'z'), range('A', 'Z'), range('0', '9'));
            for ($i = 0; $i <= 25; $i++) {
                $key .= $keys[array_rand($keys)];
            }
            $frontImageName = env('APP_URL') . "uploads/" . $key . $request->frontImage->getClientOriginalName();
            $request->frontImage->move(public_path('uploads'), $frontImageName);
            Money::whereId($id)->first()->update([
                'frontImage' => $frontImageName,
            ]);
        }
        if ($request->hasFile('backImage')) {
            $request->validate([
                "backImage" => "required|file|mimes:jpg,jpeg,png|max:2048",
            ]);
            $key = '';
            $keys = array_merge(range('a', 'z'), range('A', 'Z'), range('0', '9'));
            for ($i = 0; $i <= 25; $i++) {
                $key .= $keys[array_rand($keys)];
            }
            $backImageName = env('APP_URL') . "uploads/" . $key . $request->backImage->getClientOriginalName();
            $request->backImage->move(public_path('uploads'), $backImageName);
            Money::whereId($id)->first()->update([
                'backImage' => $backImageName,
            ]);
        }

        $moneyData = Money::whereId($id)->first()->update([
            "emissionId" => $request->emissionId,
            "scwpmId" => $request->scwpmId,
            "kuphurId" => $request->kuphurId,
            "value" => $request->value,
            "serieId" => $request->serieId,
            "cilValue" => $request->cilValue,
            "ctValue" => $request->ctValue,
            "tValue" => $request->tValue,
            "tertipId" => $request->tertipId,
            "size" => $request->size,
            "printPlace" => $request->printPlace,
            "tedavulDate" => $request->tedavulDate,
            "lastDate" => $request->lastDate,
            "zortedDate" => $request->zortedDate,
            "timeoutDate" => $request->timeoutDate,
            "expiryDate" => $request->expiryDate,
            "frontColor" => $request->frontColor,
            "backColor" => $request->backColor,
            "link" => $request->link,
            "desc" => $request->desc,
            "status" => $request->status,
        ]);

        if ($moneyData) {
            if ($request->signature) {
                MoneySignatures::where('moneyId', $id)->delete();
                $signatures = explode(",", $request->signatures);
                foreach ($signatures as $sign) {
                    MoneySignatures::create([
                        "moneyId" => $moneyData->id,
                        "signatureId" => $sign,
                    ]);
                }
            }
            return response()->json([
                "status" => "ok",
                "message" => "Successfully updated.",
            ], 200);
        }
        return response()->json([
            "status" => "false",
            "message" => "Money did't updated",
        ], 500);
    }
}
