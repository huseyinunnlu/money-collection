<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Serie;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Serie::where('title', 'LIKE', '%' . $request->search . '%')->where('status', $request->status)->orderBy('id', $request->sort)->paginate($request->count);
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255|unique:series,title',
            'status' => 'required'
        ]);

        $data = Serie::create([
            'title' => $request->title,
            'status' => $request->status,
        ]);
        if ($data) {
            return response()->json([
                "status" => "ok",
                "message" => "Serie added successfully.",
                "data" => $data,
            ], 200);
        }
        return response()->json([
            "status" => "false",
            "message" => "Serie didn't added.",
        ], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Serie::whereId($id)->first();
        if ($data) {
            return response()->json([
                "status" => "ok",
                "data" => $data
            ], 200);
        }
        return response()->json([
            "status" => "false",
            "message" => "Serie not found."
        ], 500);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => "required|max:255",
            'status' => 'required',
        ]);
        $data = Serie::whereId($id)->first()->update([
            'title' => $request->title,
            'status' => $request->status,
        ]);

        if ($data) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Serie successfully updated',
            ], 200);
        }
        return response()->json([
            'status' => 'false',
            'message' => "Serie didn't updated",
        ], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Serie::whereId($id)->delete();
        if ($data) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Serie successfuly deleted',
            ], 200);
        }
        return response()->json([
            'status' => 'false',
            'message' => "Serie didn't deleted",
        ], 500);
    }
}
