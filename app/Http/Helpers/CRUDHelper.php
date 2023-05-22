<?php

namespace App\Http\Helpers;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class CRUDHelper
{
    public static function remove_item($model, $id): \Illuminate\Http\RedirectResponse
    {
        try {
            $modelItem = $model::find($id);
            if (file_exists($modelItem->photo)) {
                unlink(public_path($modelItem->photo));
            }
            $modelItem->delete();
            alert()->success(__('messages.delete-success'));
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
        }
        return Redirect::back();
    }

    public static function status($model, $id): \Illuminate\Http\RedirectResponse
    {
        $status = $model::where('id', $id)->value('status');
        if ($status == 1) {
            $model::where('id', $id)->update(['status' => 0]);
        } else {
            $model::where('id', $id)->update(['status' => 1]);
        }
        return Redirect::back();
    }
}

