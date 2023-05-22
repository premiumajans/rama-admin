<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Create\SiteLanguageRequest;
use App\Http\Requests\Backend\Update\SiteLanguageRequest as updateRequest;

use App\Models\SiteLanguage;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class SiteLanguageController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('languages index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $siteLanguages = SiteLanguage::all();
        return view('backend.site-languages.index', get_defined_vars());
    }
    public function create()
    {
        abort_if(Gate::denies('languages create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.site-languages.create');
    }
    public function edit($id)
    {
        abort_if(Gate::denies('languages edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $language = SiteLanguage::find($id);
        return view('backend.site-languages.edit', get_defined_vars());
    }
    public function store(SiteLanguageRequest $request)
    {
        abort_if(Gate::denies('languages create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $icon = upload('flags', $request->file('icon'));
            $siteLanguage = new SiteLanguage();
            $siteLanguage->name = $request->name;
            $siteLanguage->code = $request->code;
            $siteLanguage->icon = $icon;
            $siteLanguage->status = 1;
            $siteLanguage->save();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.site-languages.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.site-languages.index');
        }
    }

    public function update(updateRequest $request, $id)
    {
        abort_if(Gate::denies('languages edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            if ($request->hasFile('icon')) {
                unlink(SiteLanguage::find($id)->icon);
                $icon = upload('icons', $request->file('icon'));
            }
            SiteLanguage::find($id)->update([
                'name' => $request->name,
                'code' => $request->code,
                'icon' => ($request->hasFile('icon') ? $icon : SiteLanguage::find($id)->icon),
            ]);
            alert()->success(__('messages.success'));
            return redirect()->route('backend.site-languages.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.site-languages.index');
        }
    }

    public function siteLanStatus($id)
    {
        abort_if(Gate::denies('languages index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $status = SiteLanguage::where('id', $id)->value('status');
        if ($status == 1) {
            SiteLanguage::where('id', $id)->update(['status' => 0]);
        } else {
            SiteLanguage::where('id', $id)->update(['status' => 1]);
        }
        return redirect()->route('backend.site-languages.index');
    }

    public function delSiteLang($id)
    {
        abort_if(Gate::denies('languages delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            unlink(SiteLanguage::find($id)->icon);
            SiteLanguage::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.site-languages.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.site-languages.index');
        }
    }
}
