<?php

namespace App\Http\Requests\Front\Routes;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class IndexRouteRequest
 *
 * @property string $date_from
 * @property string $date_to
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
            'date_from' => 'sometimes|nullable|string',
            'date_to' => 'sometimes|nullable|string',
            'type_id' => 'sometimes|nullable|exists:dictionaries,id',
            'transport_id' => 'sometimes|nullable|exists:dictionaries,id',
            'whom_id' => 'sometimes|nullable|exists:dictionaries,id',
        ];
    }

}
