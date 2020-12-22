<?php

namespace App\Http\Requests\Admin\Routes;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class MassDestroyRouteRequest
 *
 * @property array $ids
 */
class MassDestroyRouteRequest extends FormRequest
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
