<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use App\Models\ContentPhotos;
use App\Models\ContentTranslation;
use Exception;
use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\DB;

class ContentController extends Controller
{
    public function index()
    {
        check_permission('content index');
        $contents = Content::with('photos')->get();
        return view('backend.content.index', get_defined_vars());
    }

    public function create()
    {
        check_permission('content create');
        return view('backend.content.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        check_permission('content create');
        try {
            $content = new Content();
            if ($request->hasFile('pdf')) {
                $content->pdf = pdf_upload($request->file('pdf'));
            }
            if ($request->hasFile('photo')) {
                $content->photo = upload('content', $request->file('photo'));
            }
            $content->category_id = $request->category;
            $content->alt_id = $request->altCategory;
            $content->sub_id = $request->subCategory;
            $content->save();
            foreach (active_langs() as $lang) {
                $contentTranslation = new ContentTranslation();
                $contentTranslation->locale = $lang->code;
                $contentTranslation->content_id = $content->id;
                $contentTranslation->name = $request->name[$lang->code];
                $contentTranslation->content = $request->content1[$lang->code];
                $contentTranslation->save();
            }
            if ($request->hasFile('photos')) {
                foreach (multi_upload('content', $request->file('photos')) as $photo) {
                    $contentPhoto = new ContentPhotos();
                    $contentPhoto->photo = $photo;
                    $content->photos()->save($contentPhoto);
                }
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.content.index'));
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('backend.content.index'));
        }
    }

    public function edit(string $id)
    {
        check_permission('content edit');
        $content = Content::where('id', $id)->with('photos')->first();
        return view('backend.content.edit', get_defined_vars());
    }

    public function update(Request $request, string $id)
    {
        check_permission('content edit');
        try {
            $content = Content::where('id', $id)->with('photos')->first();
            DB::transaction(function () use ($request, $content) {
                $content->category_id = $request->category;
                $content->alt_id = $request->altCategory;
                $content->sub_id = $request->subCategory;
                if ($request->hasFile('pdf')) {
                    if (file_exists($content->pdf)) {
                        unlink(public_path($content->pdf));
                    }
                    $content->pdf = pdf_upload($request->file('pdf'));
                }
                if ($request->hasFile('photo')) {
                    if (file_exists($content->photo)) {
                        unlink(public_path($content->photo));
                    }
                    $content->photo = upload('content', $request->file('photo'));
                }
                if ($request->hasFile('photos')) {
                    foreach (multi_upload('content', $request->file('photos')) as $photo) {
                        $contentPhoto = new ContentPhotos();
                        $contentPhoto->photo = $photo;
                        $content->photos()->save($contentPhoto);
                    }
                }
                foreach (active_langs() as $lang) {
                    $content->translate($lang->code)->name = $request->name[$lang->code];
                    $content->translate($lang->code)->content = $request->content1[$lang->code];
                }
                $content->save();
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
        check_permission('content edit');
        return CRUDHelper::status('\App\Models\Content', $id);
    }

    public function delete(string $id)
    {
        check_permission('content delete');
        return CRUDHelper::remove_item('\App\Models\Content', $id);
    }

    public function deletePhoto($id)
    {
        check_permission('content delete');
        return CRUDHelper::remove_item('\App\Models\ContentPhotos', $id);
    }
}
