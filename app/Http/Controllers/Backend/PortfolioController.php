<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use App\Models\PortfolioPhotos;
use App\Models\PortfolioTranslation;
use Exception;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use Illuminate\Support\Facades\DB;

class PortfolioController extends Controller
{
    public function index()
    {
        check_permission('portfolio index');
        $portfolios = Portfolio::with('photos')->get();
        return view('backend.portfolio.index', get_defined_vars());
    }

    public function create()
    {
        check_permission('portfolio create');
        return view('backend.portfolio.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        check_permission('portfolio create');
        try {

            alert()->success(__('messages.success'));
            return redirect(route('backend.portfolio.index'));
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('backend.portfolio.index'));
        }
    }

    public function edit(string $id)
    {
        check_permission('portfolio edit');
        $portfolio = Portfolio::where('id', $id)->with('photos')->first();
        return view('backend.portfolio.edit', get_defined_vars());
    }

    public function update(Request $request, string $id)
    {
        check_permission('portfolio edit');
        try {
            $portfolio = Portfolio::where('id', $id)->with('photos')->first();
            DB::transaction(function () use ($request, $portfolio) {

                $portfolio->save();
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
        check_permission('portfolio edit');
        return CRUDHelper::status('\App\Models\Portfolio', $id);
    }

    public function delete(string $id)
    {
        check_permission('portfolio delete');
        return CRUDHelper::remove_item('\App\Models\Portfolio', $id);
    }
}
