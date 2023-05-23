<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Catalog;

class CatalogController extends Controller
{
    public function index()
    {
        if (Catalog::where('status', 1)->exists()) {
            return response()->json(['catalog' => Catalog::where('status', 1)->with('photos')->get()], 200);
        } else {
            return response()->json(['catalog' => 'Catalog-is-empty'], 404);
        }
    }

    public function show($id)
    {
        if (Catalog::where('status', 1)->where('id', $id)->exists()) {
            return response()->json(['catalog' => Catalog::where('status', 1)->where('id', $id)->first()], 200);
        } else {
            return response()->json(['catalog' => 'catalog-is-not-founded'], 404);
        }
    }
}
