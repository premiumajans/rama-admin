<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use App\Models\ProductPhotos;
use App\Models\ProductTranslation;
use Exception;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        check_permission('product index');
        $products = Product::with('photos')->get();
        return view('backend.product.index', get_defined_vars());
    }

    public function create()
    {
        check_permission('product create');
        return view('backend.product.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        check_permission('product create');
        try {

            alert()->success(__('messages.success'));
            return redirect(route('backend.product.index'));
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('backend.product.index'));
        }
    }

    public function edit(string $id)
    {
        check_permission('product edit');
        $product = Product::where('id', $id)->with('photos')->first();
        return view('backend.product.edit', get_defined_vars());
    }

    public function update(Request $request, string $id)
    {
        check_permission('product edit');
        try {
            $product = Product::where('id', $id)->with('photos')->first();
            DB::transaction(function () use ($request, $product) {

                $product->save();
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
        check_permission('product edit');
        return CRUDHelper::status('\App\Models\Product', $id);
    }

    public function delete(string $id)
    {
        check_permission('product delete');
        return CRUDHelper::remove_item('\App\Models\Product', $id);
    }
}
