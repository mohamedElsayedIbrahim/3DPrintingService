<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function index()
    {
        return view('pages.calculator');
    }

    public function calculate(Request $request)
    {
        $cost = ($request->material * $request->volume * $request->quality);
        return response()->json(['total' => $cost]);
    }
}

