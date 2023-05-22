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
