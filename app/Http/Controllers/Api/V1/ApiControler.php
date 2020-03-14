<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiControler extends Controller
{
    public function getBalans (Request $request) {
        return response()->json([
            'balans' => $request->user()->getBalans(),
            'message' => 'OK'
        ],200);
    }
}
