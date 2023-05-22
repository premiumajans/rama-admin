<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Create\AdminRequest as CreateRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    public function index()
    {
        check_permission('users index');
        $users = Admin::all();
        return view('backend.users.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('users create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.users.create');
    }

    public function delAdmin($id)
    {
       check_permission('users delete');
       CRUDHelper::remove_item('App\Models\Admin',$id);
    }
    public function store(CreateRequest $request)
    {
        abort_if(Gate::denies('users create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $user = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            alert()->success(__('messages.success'));
            return redirect()->route('backend.users.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.users.index');
        }
    }
}
