<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        if (Service::where('status', 1)->exists()) {
            return response()->json(['service' => Service::where('status', 1)->with('photos')->get()], 200);
        } else {
            return response()->json(['service' => 'Service-is-empty'], 404);
        }
    }

    public function show($id)
    {
        if (Service::where('status', 1)->where('id', $id)->exists()) {
            return response()->json(['service' => Service::where('status', 1)->where('id', $id)->with('photos')->first()], 200);
        } else {
            return response()->json(['service' => 'service-is-not-founded'], 404);
        }
    }
}
