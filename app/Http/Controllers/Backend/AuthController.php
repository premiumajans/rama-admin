<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class AuthController extends Controller
{
    use Authenticatable;

    protected function guard()
    {
        return auth()->guard('admin');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        if ($this->guard()->attempt($request->only(['email', 'password']), $request->remember_me)) {
            $user = auth()->guard('admin')->user();
            return redirect()->route('backend.dashboard');
        } else {
            activity()
                ->withProperties(['email' => $request->email])
                ->log('Failed login attempt');
            return back();
        }
    }

    protected function authenticated(Request $request, $user)
    {
        return response()->json([
            'token' => $user->createToken('API Token')->accessToken,
        ]);
    }
}
