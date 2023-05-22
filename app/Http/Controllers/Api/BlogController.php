<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        if (Blog::where('status', 1)->exists()) {
            return response()->json(['blog' => Blog::where('status', 1)->with('photos')->get()], 200);
        } else {
            return response()->json(['blog' => 'Blog-is-empty'], 404);
        }
    }

    public function show($id)
    {
        if (Blog::where('status', 1)->where('id', $id)->exists()) {
            return response()->json(['blog' => Blog::where('status', 1)->where('id', $id)->first()], 200);
        } else {
            return response()->json(['blog' => 'blog-is-not-founded'], 404);
        }
    }
}
