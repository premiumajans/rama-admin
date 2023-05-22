<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use App\Models\Admin;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class PermissionController extends Controller
{
    public function index()
    {
        check_permission('permissions index');
        $permissions = Permission::all();
        return view('backend.permissions.index', get_defined_vars());
    }

    public function create()
    {
        check_permission('permissions create');
        return view('backend.permissions.create');
    }

    public function store(Request $request)
    {
        check_permission('permissions create');
        try {
            Permission::create([
                'name' => $request->name,
                'guard_name' => $request->guardName,
            ]);
            alert()->success(__('messages.add-success'));
            return redirect()->route('backend.permissions.index');
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.permissions.index');
        }
    }

    public function edit(Permission $permission)
    {
        check_permission('permissions edit');
        return view('backend.permissions.edit', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        check_permission('permissions edit');
        try {
            Permission::find($id)->update([
                'name' => $request->name,
                'guard_name' => $request->guardName,
            ]);
            alert()->success(__('messages.success'));
            return redirect()->route('backend.permissions.index');
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.permissions.index');
        }
    }

    public function givePermission()
    {
        check_permission('permissions create');
        $users = Admin::all();
        return view('backend.permissions.give', get_defined_vars());
    }

    public function giveUserPermission(Admin $user)
    {
        check_permission('permissions create');
        $permissions = Permission::where('guard_name', 'admin')->orderBy('name','asc')->get();
        return view('backend.permissions.give-user', get_defined_vars());
    }

    public function delPermission($id)
    {
        check_permission('permissions delete');
        return CRUDHelper::remove_item('\Spatie\Permission\Models\Permission', $id);
    }

    public function giveUserPermissionUpdate(Request $request)
    {
        check_permission('permissions create');
        $admin = Admin::find($request->id);
        try {
            DB::transaction(function () use ($request, $admin) {
                $admin->syncPermissions($request->permissions);
            });
            alert()->success(__('messages.success'));
            return redirect()->route('backend.giveUserPermission', $admin->id);
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.giveUserPermission', $admin->id);
        }
    }
}
