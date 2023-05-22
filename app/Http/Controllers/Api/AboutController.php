<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        if (About::where('status', 1)->exists()) {
            return response()->json(['about' => About::where('status', 1)->get()]);
        } else {
            return response()->json(['about' => 'about-not-found']);
        }
    }

    public function show($id)
    {
        if (About::where('id', $id)->exists()) {
            return response()->json(['about' =>About::find($id)]);
        } else {
            return response()->json(['about' => 'about-not-found']);
        }
    }
}
