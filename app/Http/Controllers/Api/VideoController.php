<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        if (Video::where('status', 1)->exists()) {
            return response()->json(['videos' => Video::where('status', 1)->with('photos')->get()], 200);
        } else {
            return response()->json(['videos' => 'Video-is-empty'], 404);
        }
    }

    public function show($id)
    {
        if (Video::where('status', 1)->where('id', $id)->exists()) {
            return response()->json(['video' => Video::where('status', 1)->where('id', $id)->with('video')->first()], 200);
        } else {
            return response()->json(['video' => 'Video-is-not-founded'], 404);
        }
    }
}
