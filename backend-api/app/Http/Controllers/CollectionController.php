<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\CollectionImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class CollectionController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            "moneyId" => "required",
            "images" => "array|max:4",
            "uniqueSerie" => "required|not_in:null",
            "purchasedPerson" => "nullable",
            "price" => "nullable",
            "date" => "required|date|before:" . date('Y-m-d', strtotime('+1 days')),
        ]);

        $data = Collection::create([
            "userId" => Auth::user()->id,
            "moneyId" => $request->moneyId,
            "uniqueSerie" => $request->uniqueSerie,
            "purchasedPerson" => $request->purchasedPerson,
            "price" => $request->price,
            "date" => $request->date,
        ]);
        if ($data && $request->hasFile('images')) {
            $images = [];
            foreach ($request->images as $image) {
                $validator = Validator::make(
                    ['image' => $image],
                    ['image' => 'file|required|max:2048|mimes:jpg,jpeg,png,bmp'],
                );
                $filename = $image->store('public');
                $img = CollectionImage::create([
                    'collection_id' => $data->id,
                    'image' => env('APP_URL') . $filename,
                ]);
                array_unshift($images, $img);
            }
            $data->images = $images;
        }
        if ($data) {
            return response()->json([
                "status" => 200,
                "message" => "Collection added successfully",
                "data" => $data,
            ],200);
        }
        return response()->json([
            "status" => 500,
            "message" => "Collection didn't addded"
        ],500);
    }

    public function get($id)
    {
        $data = Collection::where('moneyId',$id)->where('userId',Auth::user()->id)->with('images')->paginate(15);

        if($data) {
            return response()->json([
                "status" => 200,
                "data" => $data,
            ],200);
        }
        return response()->json([
            "status" => 500,
            "data" => [],
            "message" => "Collection not found",
        ],500);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $data = Collection::whereId($request->id)->first()->delete();

        if ($data) {
            return response()->json([
                'status' => '200',
                "message" => "Money successfully deleted to your collection",
            ], 200);
        }
        return response()->json([
            'status' => '500',
            "message" => "Money didn't deleted to your collection",
        ], 500);
    }

    public function getLastCollected()
    {
        $data = Collection::with('user', 'money.emission_id', 'money.kuphur_id', 'money.serie_id')->orderBy('created_at', 'desc')->limit(10)->get();

        if ($data) {
            return response()->json([
                "status" => "ok",
                "data" => $data,
            ], 200);
        }
        return response()->json([
            "status" => "false",
            "data" => [],
        ], 500);
    }
}
