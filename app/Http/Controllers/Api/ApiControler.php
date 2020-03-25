<?php

namespace App\Http\Controllers\Api;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiControler extends Controller
{
    public function getBalans (Request $request) {
        return response()->json(['balans' => $request->user()->getBalans()],200);
    }

    public  function listCaterories (Request $request) {
        return response()->json(Category::all(),200);
    }
}
