<?php

namespace App\Http\Requests\Admin\Hotels;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreHotelRequest
 *
 * @property string $name
 * @property array $conditions_accommodation
 * @property string $conditions_payment
 * @property array $additional_services
 * @property array $contact_desc
 * @property string $site_link
 * @property array $social_links
 * @property array $aggregator_links
 * @property array $phones
 * @property integer $price
 * @property array $location
 * @property string $lat
 * @property string $lng
 * @property boolean $active
 * @property boolean $have_food_point
 * @property boolean $recommended
 * @property string $image
 * @property array $image_gallery
 * @property array $dictionary_ids
 */
class StoreHotelRequest extends FormRequest
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
            'name' => 'sometimes|array',
            'name.*' => 'string|nullable',
            'conditions_accommodation' => 'sometimes|array',
            'conditions_accommodation.*' => 'string|nullable',
            'conditions_payment' => 'required|string',
            'additional_services' => 'sometimes|array',
            'additional_services.*' => 'string|nullable',
            'contact_desc' => 'sometimes|array',
            'contact_desc.*' => 'string|nullable',
            'active' => 'required|bool',
            'have_food_point' => 'required|bool',
            'recommended' => 'required|bool',
            'lat' => 'required|string',
            'lng' => 'required|string',
            'site_link' => 'sometimes|nullable|string',
            'social_links' => 'sometimes|nullable|array',
            'aggregator_links' => 'sometimes|nullable|array',
            'phones' => 'sometimes|nullable|array',
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
