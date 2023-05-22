<?php

namespace App\Http\Requests\Backend\Create;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:settings',
            'link' => 'required',
        ];
    }
}
