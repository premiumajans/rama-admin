<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use App\Models\MediaPhotos;
use App\Models\MediaTranslation;
use Exception;
use Illuminate\Http\Request;
use App\Models\Media;
use Illuminate\Support\Facades\DB;

class MediaController extends Controller
{
    public function index()
    {
        check_permission('media index');
        $medias = Media::with('photos')->get();
        return view('backend.media.index', get_defined_vars());
    }

    public function create()
    {
        check_permission('media create');
        return view('backend.media.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        check_permission('media create');
        try {

            alert()->success(__('messages.success'));
            return redirect(route('backend.media.index'));
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('backend.media.index'));
        }
    }

    public function edit(string $id)
    {
        check_permission('media edit');
        $media = Media::where('id', $id)->with('photos')->first();
        return view('backend.media.edit', get_defined_vars());
    }

    public function update(Request $request, string $id)
    {
        check_permission('media edit');
        try {
            $media = Media::where('id', $id)->with('photos')->first();
            DB::transaction(function () use ($request, $media) {

                $media->save();
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
        check_permission('media edit');
        return CRUDHelper::status('\App\Models\Media', $id);
    }

    public function delete(string $id)
    {
        check_permission('media delete');
        return CRUDHelper::remove_item('\App\Models\Media', $id);
    }
}
