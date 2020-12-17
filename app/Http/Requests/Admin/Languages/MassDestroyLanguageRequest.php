<?php

namespace App\Http\Requests\Admin\Languages;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class MassDestroyLanguageRequest
 * @property array $ids
 */
class MassDestroyLanguageRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:languages,id',
        ];
    }

}
