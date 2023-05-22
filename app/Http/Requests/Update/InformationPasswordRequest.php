<?php

namespace App\Http\Requests\Update;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InformationPasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'password' => ['required', 'min:6'],
            'password_confirmation' => ['required_with:password', 'same:password'],
            'current_password' => ['required', function ($attribute, $value) {
                if (!Hash::check($value, Auth::user()->password)) {
                    return redirect()->back()->with('errorPassword', 'Cari şifrənizi düzgün daxil edin!');
                }
            }]
        ];
    }
}
