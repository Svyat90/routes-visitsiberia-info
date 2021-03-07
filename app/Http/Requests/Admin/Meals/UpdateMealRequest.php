<?php

namespace App\Http\Requests\Admin\Meals;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateMealRequest
 *
 * @property int $id
 * @property array $name
 * @property array $description
 * @property array $working_hours
 * @property bool $active
 * @property bool $recommended
 * @property bool $have_breakfasts
 * @property bool $have_business_lunch
 * @property bool $delivery_available
 * @property string $site_link
 * @property string $social_links
 * @property string $phones
 * @property string $lat
 * @property string $lng
 * @property array $location
 * @property string $image
 * @property array $image_gallery
 * @property array $dictionary_ids
 */
class UpdateMealRequest extends FormRequest
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
            'id' => 'required|int|exists:meals,id',
            'name' => 'sometimes|array',
            'name.*' => 'string|nullable',
            'description' => 'sometimes|array',
            'description.*' => 'string|nullable',
            'working_hours' => 'sometimes|array',
            'working_hours.*' => 'string|nullable',
            'active' => 'required|bool',
            'recommended' => 'required|bool',
            'have_breakfasts' => 'required|bool',
            'have_business_lunch' => 'required|bool',
            'delivery_available' => 'required|bool',
            'site_link' => 'sometimes|nullable|string',
            'social_links' => 'sometimes|nullable|array',
            'aggregator_links' => 'sometimes|nullable|array',
            'phones' => 'sometimes|nullable|array',
            'lat' => 'required|string',
            'lng' => 'required|string',
            'location' => 'sometimes|array',
            'location.*' => 'string|nullable',
            'image' => 'required|string',
            'image_gallery' => 'sometimes|nullable|array',
            'image_gallery.*' => 'required|string',
            'dictionary_ids'   => 'sometimes|array',
            'dictionary_ids.*' => 'integer|exists:dictionaries,id',
        ];
    }

}
