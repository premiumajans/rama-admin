<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AltCategoryTranslation;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\ContentTranslation;
use App\Models\SubCategory;
use App\Models\SubCategoryTranslation;
use Illuminate\Http\Request;
use App\Models\Content;

class SearchController extends Controller
{
    public function search($keyword)
    {
        $result = [];
        $categoryTranslationsResults = array_unique(CategoryTranslation::where('name', 'LIKE', '%' . $keyword . '%')->pluck('category_id')->toArray());
        $contentForCategory = Content::whereIn('category_id', $categoryTranslationsResults)->pluck('id')->toArray();
        $altTranslationsResults = AltCategoryTranslation::where('name', 'LIKE', '%' . $keyword . '%')->pluck('alt_category_id')->toArray();
        $contentForAlt = Content::whereIn('category_id', $altTranslationsResults)->pluck('id')->toArray();
        $subTranslationsResults = SubCategoryTranslation::where('name', 'LIKE', '%' . $keyword . '%')->pluck('sub_category_id')->toArray();
        $contentForSub = Content::whereIn('category_id', $subTranslationsResults)->pluck('id')->toArray();
        $contentTranslations = ContentTranslation::where('name', 'LIKE', '%' . $keyword . '%')
            ->orWhere('content', 'LIKE', '%' . $keyword . '%')
            ->pluck('content_id')->toArray();
        $result = array_unique(array_merge($contentForCategory, $contentForAlt, $contentForSub, $contentTranslations));
        if (!empty($result)) {
            $searchResults = Content::whereIn('id', $result)->get();
        } else {
            $searchResults = 'result-not-fount';
        }
        return response()->json([
            'keyword' => $keyword,
            'result' => $searchResults,
        ], 200);
    }
}
