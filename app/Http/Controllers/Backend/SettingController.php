<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use App\Http\Requests\Backend\Create\SettingRequest as CreateRequest;
use App\Http\Requests\Backend\Update\SettingRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class SettingController extends Controller
{
    public function index()
    {
        check_permission('settings index');
        $settings = Setting::all();
        return view('backend.settings.index',get_defined_vars());
    }

    public function edit($id)
    {
        check_permission('settings edit');
        $currentSetting = Setting::find($id);
        return view('backend.settings.edit', get_defined_vars());
    }

    public function create()
    {
        check_permission('settings create');
        return view('backend.settings.create');
    }

    public function store(CreateRequest $request)
    {
        check_permission('settings create');
        try {
            $setting = new Setting();
            $setting->name = $request->name;
            $setting->link = $request->link;
            $setting->status = 1;
            $setting->save();
            alert()->success(__('messages.add-success'));
            return redirect(route('backend.settings.index'));
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.settings.index'));
        }
    }

    public function delSetting($id)
    {
        check_permission('settings delete');
        return CRUDHelper::remove_item('\App\Models\Setting',$id);
    }

    public function settingStatus($id)
    {
        $status = Setting::where('id', $id)->value('status');
        if ($status == 1) {
            Setting::where('id', $id)->update(['status' => 0]);
        } else {
            Setting::where('id', $id)->update(['status' => 1]);
        }
        return redirect()->route('backend.settings.index');
    }

    public function update(SettingRequest $request, $id)
    {
        abort_if(Gate::denies('settings edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Setting::find($id)->update([
                'name' => $request->name,
                'link' => $request->link,
            ]);
            alert()->success(__('messages.success'));
            return redirect(route('backend.settings.index'));
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.settings.index'));
        }
    }
}
