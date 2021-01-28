<?php

namespace App\Http\Requests\Front\Hotels;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class IndexHotelRequest
 *
 * @property string $city_id
 * @property string $distance_id
 * @property string $placement_id
 */
class IndexHotelRequest extends FormRequest
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
            'distance_id' => 'sometimes|nullable|exists:dictionaries,id',
            'placement_id' => 'sometimes|nullable|exists:dictionaries,id',
        ];
    }

}
