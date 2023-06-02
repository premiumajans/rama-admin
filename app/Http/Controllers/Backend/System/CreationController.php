<?php

namespace App\Http\Controllers\Backend\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreationController extends Controller
{
    public function index()
    {
        return view('backend.system.creation.index');
    }
}
