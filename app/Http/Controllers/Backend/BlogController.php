<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use App\Models\BlogPhotos;
use App\Models\BlogTranslation;
use Exception;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index()
    {
        check_permission('blog index');
        $blogs = Blog::with('photos')->get();
        return view('backend.blog.index', get_defined_vars());
    }

    public function create()
    {
        check_permission('blog create');
        return view('backend.blog.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        check_permission('blog create');
        try {
            $blog = new Blog();
            $blog->photo = upload('blog', $request->file('photo'));
            $blog->save();
            foreach (active_langs() as $lang) {
                $translation = new BlogTranslation();
                $translation->locale = $lang->code;
                $translation->blog_id = $blog->id;
                $translation->name = $request->name[$lang->code];
                $translation->description = $request->description[$lang->code];
                $translation->save();
            }
            if ($request->hasFile('photos')) {
                foreach (multi_upload('blog', $request->file('photos')) as $photo) {
                    $blogPhoto = new BlogPhotos();
                    $blogPhoto->photo = $photo;
                    $blog->photos()->save($blogPhoto);
                };
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.blog.index'));
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('backend.blog.index'));
        }
    }

    public function edit(string $id)
    {
        check_permission('blog edit');
        $blog = Blog::where('id', $id)->with('photos')->first();
        return view('backend.blog.edit', get_defined_vars());
    }

    public function update(Request $request, string $id)
    {
        check_permission('blog edit');
        try {
            $blog = Blog::where('id', $id)->with('photos')->first();
            DB::transaction(function () use ($request, $blog) {
                if ($request->hasFile('photo')) {
                    if (file_exists($blog->photo)) {
                        unlink(public_path($blog->photo));
                    }
                    $blog->photo = upload('blog', $request->file('photo'));
                }
                if ($request->hasFile('photos')) {
                    foreach (multi_upload('blog', $request->file('photos')) as $photo) {
                        $blogPhoto = new BlogPhotos();
                        $blogPhoto->photo = $photo;
                        $blog->photos()->save($blogPhoto);
                    }
                }
                foreach (active_langs() as $lang) {
                    $blog->translate($lang->code)->name = $request->name[$lang->code];
                    $blog->translate($lang->code)->description = $request->description[$lang->code];
                }
                $blog->save();
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
        check_permission('blog edit');
        return CRUDHelper::status('\App\Models\Blog', $id);
    }

    public function delete(string $id)
    {
        check_permission('blog delete');
        return CRUDHelper::remove_item('\App\Models\Blog', $id);
    }
}
