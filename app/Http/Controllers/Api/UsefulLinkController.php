<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UseFulLink;
use Illuminate\Http\Request;

class UsefulLinkController extends Controller
{
    public function index()
    {
        if (UseFulLink::where('status', 1)->exists()) {
            $links = UseFulLink::where('status', 1)->get();
            return response()->json(['links' => $links],200);
        } else {
            return response()->json(['links' => 'links-is-empty'],404);
        }
    }

    public function show($id)
    {
        if (UseFulLink::where('id', $id)->where('status', 1)->exists()) {
            $category = UseFulLink::where('id', $id)->where('status', 1)->get();
            return response()->json(['category' => $category], 200);
        } else {
            return response()->json(['category' => 'category-is-empty'], 404);
        }
    }
}
