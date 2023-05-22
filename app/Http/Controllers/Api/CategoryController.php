<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        if (Category::with('alt.sub')->exists()) {
            $categories = Category::with('alt.sub')->get();
            return response()->json(['categories' => $categories], 200);
        } else {
            return response()->json(['categories' => 'categories-not-found'], 404);
        }
    }

    public function show($id)
    {
        if (Category::where('id', $id)->with('alt.sub')->exists()) {
            $category = Category::where('id', $id)->with('alt.sub')->get();
            return response()->json(['categories' => $category], 200);
        } else {
            return response()->json(['categories' => 'categories-not-found'], 404);
        }
    }
}
