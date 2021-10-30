<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Emission;

class EmissionController extends Controller
{
    public function get(Request $request)
    {
        $data = Emission::where('title', 'LIKE', '%' . $request->search . '%')->where('status', $request->status)->orderBy('id', $request->sort)->paginate($request->count);
        return response()->json($data);
    }

    public function add(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'status' => 'required'
        ]);

        $data = Emission::create([
            'title' => $request->title,
            'status' => $request->status,
        ]);
        if ($data) {
            return response()->json([
                "status" => "ok",
                "message" => "Emission added successfully.",
                "data" => $data,
            ], 200);
        }
        return response()->json([
            "status" => "false",
            "message" => "Emission didn't added.",
        ], 500);
    }

    public function getEmission($id)
    {
        $data = Emission::whereId($id)->first();
        if ($data) {
            return response()->json([
                "status" => "ok",
                "data" => $data
            ], 200);
        }
        return response()->json([
            "status" => "false",
            "message" => "Emission not found."
        ] ,500);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => "required|max:255",
            'status' => 'required',
        ]);
        $data = Emission::whereId($id)->first()->update([
            'title' => $request->title,
            'status' => $request->status,
        ]);

        if ($data) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Emission successfully updated',
            ], 200);
        }
        return response()->json([
            'status' => 'false',
            'message' => "Emission didn't updated",
        ], 500);
    }

    public function delete($id)
    {
        $data = Emission::whereId($id)->delete();
        if ($data) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Emission successfuly deleted',
            ], 200);
        }
        return response()->json([
            'status' => 'false',
            'message' => "Emission didn't deleted",
        ], 500);
    }
}
