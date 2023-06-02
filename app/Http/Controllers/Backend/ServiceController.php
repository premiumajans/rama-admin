<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use App\Models\ServicePhotos;
use App\Models\ServiceTranslation;
use Exception;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function index()
    {
        check_permission('service index');
        $services = Service::with('photos')->get();
        return view('backend.service.index', get_defined_vars());
    }

    public function create()
    {
        check_permission('service create');
        return view('backend.service.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        check_permission('service create');
        try {
            $service = new Service();
            $service->photo = upload('service', $request->file('photo'));
            $service->save();
            foreach (active_langs() as $lang) {
                $translation = new ServiceTranslation();
                $translation->locale = $lang->code;
                $translation->service_id = $service->id;
                $translation->name = $request->name[$lang->code];
                $translation->description = $request->description[$lang->code];
                $translation->save();
            }
            if ($request->hasFile('photos')){
                foreach (multi_upload('service', $request->file('photos')) as $photo) {
                    $servicePhoto = new ServicePhotos();
                    $servicePhoto->photo = $photo;
                    $service->photos()->save($servicePhoto);
                };
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.service.index'));
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('backend.service.index'));
        }
    }
    public function edit(string $id)
    {
        check_permission('service edit');
        $service = Service::where('id', $id)->with('photos')->first();
        return view('backend.service.edit', get_defined_vars());
    }
    public function update(Request $request, string $id)
    {
        check_permission('service edit');
        try {
            $service = Service::where('id', $id)->with('photos')->first();
            DB::transaction(function () use ($request, $service) {
                if ($request->hasFile('photo')) {
                    if (file_exists($service->photo)) {
                        unlink(public_path($service->photo));
                    }
                    $service->photo = upload('service', $request->file('photo'));
                }
                if ($request->hasFile('photos')) {
                    foreach (multi_upload('service', $request->file('photos')) as $photo) {
                        $servicePhoto = new ServicePhotos();
                        $servicePhoto->photo = $photo;
                        $service->photos()->save($servicePhoto);
                    }
                }
                foreach (active_langs() as $lang) {
                    $service->translate($lang->code)->name = $request->name[$lang->code];
                    $service->translate($lang->code)->description = $request->description[$lang->code];
                }
                $service->save();
            });
            alert()->success(__('messages.success'));
            return redirect()->back();
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect()->back();
        }
    }

    public function status(string $id)
    {
        check_permission('service edit');
        return CRUDHelper::status('\App\Models\Service', $id);
    }

    public function delete(string $id)
    {
        check_permission('service delete');
        return CRUDHelper::remove_item('\App\Models\Service', $id);
    }
}
