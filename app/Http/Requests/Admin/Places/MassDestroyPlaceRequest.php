<?php

namespace App\Http\Requests\Admin\Places;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class MassDestroyPlaceRequest
 *
 * @property array $ids
 */
class MassDestroyPlaceRequest extends FormRequest
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
            'ids.*' => 'exists:places,id',
        ];
    }

}
