<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MetaTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class MetaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('seo-tags index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $metaTags = MetaTag::all();
        return view('backend.tags.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('seo-tags create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.tags.create');
    }

    public function delSeo($id)
    {
        abort_if(Gate::denies('seo-tags delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            MetaTag::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->back();
        }
    }

    public function seoStatus($id)
    {
        abort_if(Gate::denies('seo-tags edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $status = MetaTag::where('id', $id)->value('status');
        if ($status == 1) {
            MetaTag::where('id', $id)->update(['status' => 0]);
        } else {
            MetaTag::where('id', $id)->update(['status' => 1]);
        }
        return redirect()->route('backend.seo.index');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('seo-tags create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            MetaTag::create([
                'attribute' => $request->attribute,
                'attribute_name' => $request->attribute_name,
                'content' => $request->content1,
                'status' => 1
            ]);
            alert()->success(__('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('seo-tags edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            MetaTag::find($id)->update([
                'attribute' => $request->attribute,
                'attribute_name' => $request->attribute_name,
                'content' => $request->content1,
            ]);
            alert()->success(__('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->back();
        }
    }
}
