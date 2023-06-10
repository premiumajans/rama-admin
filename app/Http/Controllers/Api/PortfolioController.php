<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;

class PortfolioController extends Controller
{
    public function index()
    {
        if (Portfolio::where('status', 1)->exists()) {
            return response()->json(['portfolio' => Portfolio::where('status', 1)->with('photos')->get()], 200);
        } else {
            return response()->json(['portfolio' => 'Portfolio-is-empty'], 404);
        }
    }

    public function show($id)
    {
        if (Portfolio::where('status', 1)->where('id', $id)->exists()) {
            return response()->json(['portfolio' => Portfolio::$where('status', 1)->where('id', $id)->with('photos')->first()], 200);
        } else {
            return response()->json(['portfolio' => 'portfolio-is-not-founded'], 404);
        }
    }
}
