<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use App\Models\Slider;
use App\Models\SliderTranslation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class SliderController extends Controller
{
    public function index()
    {
        check_permission('slider index');
        $sliders = Slider::orderBy('order')->get();
        return view('backend.slider.index', get_defined_vars());
    }

    public function create()
    {
        check_permission('slider create');
        return view('backend.slider.create');
    }

    public function store(Request $request)
    {
        check_permission('slider create');
        try {
            if (empty(Slider::first())) {
                $sliderOrder = 1;
            } else {
                $sliderOrder = Slider::all()->last()->order + 1;
            }
            $slider = new Slider();
            $slider->photo = upload('sliders', $request->file('photo'));
            $slider->alt = $request->alt;
            $slider->order = $sliderOrder;
            $slider->save();
            foreach (active_langs() as $lang) {
                $sliderTranslation = new SliderTranslation();
                $sliderTranslation->locale = $lang->code;
                $sliderTranslation->slider_id = $slider->id;
                $sliderTranslation->title = $request->title[$lang->code];
                $sliderTranslation->save();
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.slider.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.slider.index'));
        }
    }

    public function update(Request $request, $id)
    {
        check_permission('slider edit');
        try {
            $slider = Slider::find($id);
            DB::transaction(function () use ($request, $slider) {
                if ($request->hasFile('photo')) {
                    if (file_exists($slider->photo)) {
                        unlink(public_path($slider->photo));
                    }
                    $slider->photo = upload('sliders', $request->file('photo'));
                }
                foreach (active_langs() as $lang) {
                    $slider->translate($lang->code)->title = $request->title[$lang->code];
                }
                $slider->alt = $request->alt;
                $slider->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.slider.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.slider.index'));
        }
    }

    public function edit($id)
    {
        check_permission('slider edit');
        $slider = Slider::find($id);
        return view('backend.slider.edit', get_defined_vars());
    }

    public function sliderOrder(Request $request, $id)
    {
        check_permission('slider edit');
        try {
            $slider = Slider::find($id);
            $orders = [];
            foreach (Slider::orderBy('order', 'asc')->get() as $sl) {
                $orders[] = $sl->order;
            }
            if ($request->direction == "up") {
                $prevKey = (array_search($slider->order, $orders)) - 1;
                Slider::where('order', $orders[$prevKey])->update([
                    'order' => $slider->order,
                ]);
                $slider->update(['order' => $orders[$prevKey]]);
            } else {
                if ($slider->order == end($orders)) {
                    Slider::where('order', $orders[count($orders) - 2])->update([
                        'order' => $slider->order
                    ]);
                    $slider->update(['order' => $orders[count($orders) - 2]]);
                } elseif ($slider->order == $orders[0]) {
                    Slider::where('order', $orders[1])->update([
                        'order' => $slider->order
                    ]);
                    $slider->update(['order' => $orders[1]]);
                } else {
                    $nextKey = (array_search($slider->order, $orders)) + 1;
                    Slider::where('order', $orders[$nextKey])->update([
                        'order' => $orders[$nextKey - 1],
                    ]);
                    $slider->update(['order' => $orders[$nextKey]]);
                }
            }

            alert()->success(__('messages.success'));
            return redirect(route('backend.slider.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.slider.index'));
        }
    }

    public function delSlider($id)
    {
        check_permission('slider delete');
        return CRUDHelper::remove_item('\App\Models\Slider', $id);
    }

    public function sliderStatus($id)
    {
        check_permission('slider edit');
        return CRUDHelper::status('\App\Models\Slider', $id);
    }
}
