<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Partner;

class PartnerController extends Controller
{
    public function index()
    {
        if (Partner::all()) {
            return response()->json(['partner' => Partner::all()], 200);
        } else {
            return response()->json(['partner' => 'Partner-is-empty'], 404);
        }
    }

    public function show($id)
    {
        if (Partner::where('status', 1)->where('id', $id)->exists()) {
            return response()->json(['partner' => Partner::where('id', $id)->first()], 200);
        } else {
            return response()->json(['partner' => 'partner-is-not-founded'], 404);
        }
    }
}
