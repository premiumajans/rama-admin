<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AltCategory;
use App\Models\AltCategoryTranslation;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\SubCategory;
use App\Models\SubCategoryTranslation;
use Illuminate\Support\Facades\File;
use function Sodium\add;

class HomeController extends Controller
{
    public function index()
    {
        return view('backend.dashboard', get_defined_vars());
    }
}
