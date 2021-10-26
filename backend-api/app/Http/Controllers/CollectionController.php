<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            "userId" => "required",
            "moneyId" => "required",
        ]);

        $iscollection = Collection::where('userId', $request->userId)->where('moneyId', $request->moneyId)->first();
        if ($iscollection) {
            return response()->json([
                "status" => "false",
                "message" => "Money already exist in your collection.",
            ],500);
        }

        Collection::create([
            "userId" => $request->userId,
            "moneyId" => $request->moneyId,
        ]);
        return response()->json([
            "status" => "ok",
            "message" => "Money successfully added to your money collection",
        ], 200);
    }

    public function delete(Request $request)
    {
        $data = Collection::where('userId',$request->userId)->where('moneyId',$request->moneyId)->first()->delete();

        if($data) {
            return response()->json([
                'status' => 'ok',
                "message" => "Money successfully deleted to your collection",
            ] ,200);
        }
        return response()->json([
            'status' => 'false',
            "message" => "Money didn't deleted to your collection",
        ] ,500);
    }
}
