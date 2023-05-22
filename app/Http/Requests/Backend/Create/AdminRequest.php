<?php

namespace App\Http\Requests\Backend\Create;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:5',
            'password_confirmation' => 'required|same:password',
        ];
    }
}
