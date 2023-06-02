<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use App\Models\CatalogPhotos;
use App\Models\CatalogTranslation;
use Exception;
use Illuminate\Http\Request;
use App\Models\Catalog;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
{
    public function index()
    {
        check_permission('catalog index');
        $catalogs = Catalog::with('photos')->get();
        return view('backend.catalog.index', get_defined_vars());
    }

    public function create()
    {
        check_permission('catalog create');
        return view('backend.catalog.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        check_permission('catalog create');
        try {
            $catalog = new Catalog();
            $catalog->photo = upload('catalog', $request->file('photo'));
            $catalog->save();
            foreach (active_langs() as $lang) {
                $translation = new CatalogTranslation();
                $translation->locale = $lang->code;
                $translation->catalog_id = $catalog->id;
                $translation->name = $request->name[$lang->code];
                $translation->description = $request->description[$lang->code];
                $translation->save();
            }
            if ($request->hasFile('photos')){
                foreach (multi_upload('catalog', $request->file('photos')) as $photo) {
                    $catalogPhoto = new CatalogPhotos();
                    $catalogPhoto->photo = $photo;
                    $catalog->photos()->save($catalogPhoto);
                };
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.catalog.index'));
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('backend.catalog.index'));
        }
    }

    public function edit(string $id)
    {
        check_permission('catalog edit');
        $catalog = Catalog::where('id', $id)->with('photos')->first();
        return view('backend.catalog.edit', get_defined_vars());
    }

    public function update(Request $request, string $id)
    {
        check_permission('catalog edit');
        try {
            $catalog = Catalog::where('id', $id)->with('photos')->first();
            DB::transaction(function () use ($request, $catalog) {
                if ($request->hasFile('photo')) {
                    if (file_exists($catalog->photo)) {
                        unlink(public_path($catalog->photo));
                    }
                    $catalog->photo = upload('catalog', $request->file('photo'));
                }
                if ($request->hasFile('photos')) {
                    foreach (multi_upload('catalog', $request->file('photos')) as $photo) {
                        $catalogPhoto = new CatalogPhotos();
                        $catalogPhoto->photo = $photo;
                        $catalog->photos()->save($catalogPhoto);
                    }
                }
                foreach (active_langs() as $lang) {
                    $catalog->translate($lang->code)->name = $request->name[$lang->code];
                    $catalog->translate($lang->code)->description = $request->description[$lang->code];
                }
                $catalog->save();
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
        check_permission('catalog edit');
        return CRUDHelper::status('\App\Models\Catalog', $id);
    }

    public function delete(string $id)
    {
        check_permission('catalog delete');
        return CRUDHelper::remove_item('\App\Models\Catalog', $id);
    }
}
