<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use App\Http\Requests\Backend\Update\CategoryRequest as UpdateRequest;
use App\Models\AltCategory;
use App\Models\SubCategory;
use App\Models\SubCategoryTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    public function index()
    {
        check_permission('categories index');
        $categories = SubCategory::all();
        return view('backend.sub-category.index', get_defined_vars());
    }

    public function create()
    {
        check_permission('categories create');
        $altCategories = AltCategory::with('category')->get();
        return view('backend.sub-category.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        check_permission('categories create');
        try {
            $commonCategory = AltCategory::where('id', $request->altCategory)->with('sub')->first();
            $category = new SubCategory();
            $category->slug = $request->slug;
            $commonCategory->sub()->save($category);
            foreach (active_langs() as $lc) {
                $trans = new SubCategoryTranslation();
                $trans->name = $request->name[$lc->code];
                $trans->locale = $lc->code;
                $trans->sub_category_id = $category->id;
                $trans->save();
            }
            alert()->success(__('messages.success'));
            return redirect()->route('backend.sub-categories.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.sub-categories.index');
        }
    }

    public function edit($id)
    {
        check_permission('categories edit');
        $category = SubCategory::find($id);
        $categories = AltCategory::with('category')->get();
        return view('backend.sub-category.edit', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        check_permission('categories edit');
        $category = SubCategory::find($id);
        try {
            DB::transaction(function () use ($request, $category) {
                $category->slug = $request->slug;
                $category->alt_category_id = $request->altCategory;
                foreach (active_langs() as $lang) {
                    $category->translate($lang->code)->name = $request->name[$lang->code];
                }
                $category->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.sub-categories.index'));
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.sub-categories.index'));
        }
    }

    public function delete($id)
    {
        check_permission('categories delete');
        return CRUDHelper::remove_item('\App\Models\SubCategory', $id);
    }
}
