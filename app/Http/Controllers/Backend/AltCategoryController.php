<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use App\Http\Requests\Backend\Create\CategoryRequest as CreateRequest;
use App\Http\Requests\Backend\Update\CategoryRequest as UpdateRequest;
use App\Models\AltCategory;
use App\Models\AltCategoryTranslation;
use App\Models\Category;
use App\Models\CategoryTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class AltCategoryController extends Controller
{
    public function index()
    {
        check_permission('categories index');
        $categories = AltCategory::all();
        return view('backend.alt-categories.index', get_defined_vars());
    }

    public function create()
    {
        check_permission('categories create');
        $categories = Category::all();
        return view('backend.alt-categories.create', get_defined_vars());
    }

    public function store(CreateRequest $request)
    {
        check_permission('categories create');
        try {
            $commonCategory = Category::where('id', $request->category)->with('alt')->first();
            $category = new AltCategory();
            $category->slug = $request->slug;
            $commonCategory->alt()->save($category);
            foreach (active_langs() as $lc) {
                $trans = new AltCategoryTranslation();
                $trans->name = $request->name[$lc->code];
                $trans->locale = $lc->code;
                $trans->alt_category_id = $category->id;
                $trans->save();
            }
            alert()->success(__('messages.success'));
            return redirect()->route('backend.alt-categories.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.alt-categories.index');
        }
    }

    public function edit($id)
    {
        check_permission('categories edit');
        $category = AltCategory::find($id);
        $categories = Category::all();
        return view('backend.alt-categories.edit', get_defined_vars());
    }

    public function update(UpdateRequest $request, $id)
    {
        check_permission('categories edit');
        $category = AltCategory::find($id);
        try {
            DB::transaction(function () use ($request, $category) {
                $category->slug = $request->slug;
                $category->category_id = $request->category;
                foreach (active_langs() as $lang) {
                    $category->translate($lang->code)->name = $request->name[$lang->code];
                }
                $category->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.alt-categories.index'));
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.alt-categories.index'));
        }
    }

    public function delete($id)
    {
        check_permission('categories delete');
        return CRUDHelper::remove_item('\App\Models\AltCategory', $id);
    }

    public function status($id)
    {
        check_permission('categories edit');
        return CRUDHelper::status('\App\Models\AltCategory', $id);
    }
}
