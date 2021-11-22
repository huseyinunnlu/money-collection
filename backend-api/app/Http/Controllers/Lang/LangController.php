<?php

namespace App\Http\Controllers\Lang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LangController extends Controller
{
    public function lang(Request $request)
    {
        $data = [
            'message' => trans('test'),
        ];
        return response()->json($data, 200);
    }
}
