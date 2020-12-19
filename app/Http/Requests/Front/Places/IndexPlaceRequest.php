<?php

namespace App\Http\Requests\Front\Places;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class IndexPlaceRequest
 *
 * @property string $type_id
 * @property string $season_id
 * @property string $category_id
 * @property string $whom_id
 */
class IndexPlaceRequest extends FormRequest
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
            'type_id' => 'sometimes|nullable|exists:dictionaries,id',
            'season_id' => 'sometimes|nullable|exists:dictionaries,id',
            'category_id' => 'sometimes|nullable|exists:dictionaries,id',
            'whom_id' => 'sometimes|nullable|exists:dictionaries,id',
        ];
    }

}
