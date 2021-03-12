<?php

namespace App\Http\Requests\Front\Events;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class IndexEventRequest
 *
 * @property string $city_id
 * @property string $whom_id
 * @property string $season_id
 */
class IndexEventRequest extends FormRequest
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
            'city_id' => 'sometimes|nullable|exists:dictionaries,id',
            'whom_id' => 'sometimes|nullable|exists:dictionaries,id',
            'season_id' => 'sometimes|nullable|exists:dictionaries,id',
        ];
    }

}
