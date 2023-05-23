<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Media;

class MediaController extends Controller
{
    public function index()
    {
        if (Media::where('status', 1)->exists()) {
            return response()->json(['media' => Media::where('status', 1)->with('photos')->get()], 200);
        } else {
            return response()->json(['media' => 'Media-is-empty'], 404);
        }
    }

    public function show($id)
    {
        if (Media::where('status', 1)->where('id', $id)->exists()) {
            return response()->json(['media' => Media::where('status', 1)->where('id', $id)->first()], 200);
        } else {
            return response()->json(['media' => 'media-is-not-founded'], 404);
        }
    }
}
