<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Money;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ProfileController extends Controller
{
    public function getUser(Request $request)
    {
        $user = User::whereSlug($request->slug)->first();

        if ($user) {
            return response()->json($user);
        }

        return response()->json([
            'status' => 'false',
            'message' => 'User not found',
        ], 500);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'fullName' => "required|max:30",
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
        ]);

        $user = User::whereId(Auth::user()->id)->first()->update([
            'fullName' => $request->fullName,
            'email' => $request->email,
        ]) ?? abort(404, 'User Not found');

        if ($user) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Profile successuflly updated',
            ], 200);
        }
        return response()->json([
            'status' => 'false',
            'message' => "Profile didn't updated",
        ], 500);
    }

    public function updatepp(Request $request)
    {
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|file|mimes:jpg,png,jpeg,bmp|max:1024',
            ]);

            $key = '';
            $keys = array_merge(range('a', 'z'), range('A', 'Z'), range('0', '9'));
            for ($i = 0; $i <= 25; $i++) {
                $key .= $keys[array_rand($keys)];
            }
            $imageName = env('APP_URL') . "uploads/" . $key . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads'), $imageName);
            $user = User::whereId(Auth::user()->id)->first()->update([
                'profilePhoto' => $imageName,
            ]);

            if ($user) {
                return response()->json([
                    'status' => 'ok',
                    'url' => Auth::user()->profilePhoto,
                ], 200);
            }
        }
        User::whereId(Auth::user()->id)->first()->update([
            'profilePhoto' => 'https://i.pinimg.com/736x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg',
        ]);
        return response()->json([
            'status' => 'ok',
            'url' => Auth::user()->profilePhoto,
        ], 200);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'cpassword' => 'required|different:password',
            'password' => 'required|confirmed',
        ]);

        $user = User::whereId(Auth::user()->id)->first();
        if ($user->password == $request->cpassword) {
            $data = User::whereId(Auth::user()->id)->first()->update([
                'password' => $request->password,
            ]);
            if ($data) {
                return response()->json([
                    'status' => 'ok',
                    'message' => 'Password changed successfully',
                ], 200);
            }
        }
        return response()->json([
            'errors' => [
                'cpassword' => ['Please enter your correct password.'],
            ],
        ], 422);
    }

    public function getStatics(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $data = Collection::where('userId', $request->id)
            ->select('id')
            ->count();

        $moneyCount = Money::where('status', '1')->count();
        if($moneyCount != 0 && $data != 0){
            $percent = ($data / $moneyCount) * 100;
        }else{
            $percent = 0;
        }

        $collection = Collection::with('user','money')
        ->where('userId',$request->id)
        ->orderBy('created_at','desc')
        ->get()
        ->groupBy(function($query) {
            return $query->created_at->format('Y-m-d');
        });

        return response()->json([
            'status' => 'ok',
            'result' => [
                'collectedMoney' => $data,
                'moneyCount' => $moneyCount,
                'percent' => round($percent) . '%',
                'timeline' => $collection,
            ],
        ], 200);
    }

}
