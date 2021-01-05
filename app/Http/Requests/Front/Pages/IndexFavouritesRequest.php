<?php

namespace App\Http\Requests\Front\Pages;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class IndexPlaceRequest
 *
 * @property string $type
 */
class IndexFavouritesRequest extends FormRequest
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
            'type' => 'sometimes|nullable|' . Rule::in(['places', 'events', 'meals', 'hotels']),
        ];
    }

}
