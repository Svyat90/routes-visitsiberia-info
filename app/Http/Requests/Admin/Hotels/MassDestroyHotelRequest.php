<?php

namespace App\Http\Requests\Admin\Hotels;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class MassDestroyPlaceRequest
 *
 * @property array $ids
 */
class MassDestroyHotelRequest extends FormRequest
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
