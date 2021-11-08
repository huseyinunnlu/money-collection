<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUsers(Request $request)
    {
        $data = User::
        where(function ($query) use ($request) {
            if ($request->role) {
                $query->where('role',$request->role);
            }
            if($request->search) {
                $query->where($request->column,'LIKE','%'.$request->search.'%');
            }
        })
        ->orderBy('created_at',$request->sort)
        ->paginate($request->count);

        return response()->json($data);
    }

    public function addUser(Request $request)
    {
        $request->validate([
            'fullName' => "required|max:30",
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'role' => 'required',
        ]);

        $user = User::create([
            'fullName' => $request->fullName,
            'password' => $request->password,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        if ($user) {
            return response()->json([
                'status' => 'ok',
                'message' => 'User successfuly added',
                'user' => $user,
            ], 200);
        }
        return response()->json([
            'status' => 'false',
            'message' => "User didn't added",
        ], 500);
    }

    public function delete($id)
    {
        $user = User::whereId($id)->delete();
        if ($user) {
            return response()->json([
                'status' => 'ok',
                'message' => 'User successfuly deleted',
            ], 200);
        }
        return response()->json([
            'status' => 'false',
            'message' => "User didn't deleted",
        ], 500);
    }

    public function getUser($id)
    {
        $data = User::whereId($id)->first();
        if ($data) {
            return response()->json([
                "status" => "ok",
                "data" => $data
            ], 200);
        }
        return response()->json([
            "status" => "false",
            "message" => "User not found."
        ],500);
    }

    public function updateUser(Request $request,$id)
    {
        if ($request->password) {
            $request->validate([
                'fullName' => "required|max:30",
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'required',
                'role' => 'required',
            ]);
            $user = User::whereId($id)->first()->update([
                'fullName' => $request->fullName,
                'password' => $request->password,
                'email' => $request->email,
                'role' => $request->role,
            ]);
        } else {
            $request->validate([
                'fullName' => "required|max:30",
                'email' => 'required|email|unique:users,email,' . $id,
                'role' => 'required',
            ]);

            $user = User::whereId($id)->first()->update([
                'fullName' => $request->fullName,
                'email' => $request->email,
                'role' => $request->role,
            ]);
        }
        if ($user) {
            return response()->json([
                'status' => 'ok',
                'message' => 'User successfully updated',
            ], 200);
        }
        return response()->json([
            'status' => 'false',
            'message' => "User didn't updated",
        ], 500);
    }
}
