<?php

namespace App\Http\Requests\Backend\Create;

use Illuminate\Foundation\Http\FormRequest;
use function Symfony\Component\Translation\t;

class SiteLanguageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'code' => 'required',
            'icon' => 'required|mimes:jpeg,png,jpg,gif,svg,ico',
        ];
    }
}
