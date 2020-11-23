<?php

namespace App\Http\Requests\Dictionaries;

use Illuminate\Foundation\Http\FormRequest;

class MassDestroyDictionaryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:dictionaries,id',
        ];
    }

}
