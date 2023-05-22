<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Director;
use App\Models\SiteLanguage;
use App\Http\Requests\Backend\Create\CategoryRequest as CreateRequest;
use App\Http\Requests\Backend\Update\CategoryRequest as UpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('categories index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categories = Category::all();
        return view('backend.categories.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('categories create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.categories.create');
    }

    public function categoryStatus($id)
    {
        abort_if(Gate::denies('categories edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $status = Category::where('id', $id)->value('status');
        if ($status == 1) {
            Category::where('id', $id)->update(['status' => 0]);
        } else {
            Category::where('id', $id)->update(['status' => 1]);
        }
        return redirect()->route('backend.categories.index');
    }

    public function update(UpdateRequest $request, Category $category)
    {
        abort_if(Gate::denies('categories edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            DB::transaction(function () use ($request, $category) {
                $category->slug = $request->slug;
                foreach (active_langs() as $lang) {
                    $category->translate($lang->code)->name = $request->name[$lang->code];
                }
                $category->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.categories.index'));
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.categories.index'));
        }
    }
    public function store(CreateRequest $request)
    {
        abort_if(Gate::denies('categories create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $category = new Category();
            $category->slug = $request->slug;
            $category->status = 1;
            $category->save();
            foreach (active_langs() as $lc) {
                $trans = new CategoryTranslation();
                $trans->name = $request->name[$lc->code];
                $trans->locale = $lc->code;
                $trans->category_id = $category->id;
                $trans->save();
            }
            alert()->success(__('messages.success'));
            return redirect()->route('backend.categories.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.categories.index');
        }
    }
    public function delCategory($id)
    {
        abort_if(Gate::denies('categories delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Category::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.categories.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.categories.index');
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('categories edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $category = Category::find($id);
        return view('backend.categories.edit', get_defined_vars());
    }
}
