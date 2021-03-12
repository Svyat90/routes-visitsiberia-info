<?php

namespace App\Http\Requests\Front\Routes;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class IndexRouteRequest
 *
 * @property string $season_id
 * @property string $type_id
 * @property string $transport_id
 * @property string $whom_id
 */
class IndexRouteRequest extends FormRequest
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
            'season_id' => 'sometimes|nullable|exists:dictionaries,id',
            'type_id' => 'sometimes|nullable|exists:dictionaries,id',
            'transport_id' => 'sometimes|nullable|exists:dictionaries,id',
            'whom_id' => 'sometimes|nullable|exists:dictionaries,id',
        ];
    }

}
