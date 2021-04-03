<?php

namespace App\Http\Requests\Front\Meals;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class IndexMealRequest
 *
 * @property string $city_id
 * @property string $category_id
 * @property string $delivery_id
 * @property bool $have_breakfasts
 */
class IndexMealRequest extends FormRequest
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
            'category_id' => 'sometimes|nullable|exists:dictionaries,id',
            'delivery_id' => 'sometimes|nullable|exists:dictionaries,id',
            'have_breakfasts' => 'sometimes|nullable|bool'
        ];
    }

}
