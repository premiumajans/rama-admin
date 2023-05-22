<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        if (Slider::where('status', 1)->exists()) {
            $sliders = Slider::where('status', 1)->get();
            return response()->json(['sliders' => $sliders],200);
        } else {
            return response()->json(['sliders' =>'slider-is-empty'],404);
        }
    }

    public function show($id)
    {
        if (Slider::where('id', $id)->where('status', 1)->exists()) {
            $slider = Slider::where('id', $id)->where('status', 1)->first();
            return response()->json(['slider' =>$slider],200);
        } else {
            return response()->json(['slider' =>'slider-not-found'],404);
        }
    }
}
