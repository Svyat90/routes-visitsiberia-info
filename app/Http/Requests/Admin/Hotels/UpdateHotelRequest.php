<?php

namespace App\Http\Requests\Admin\Hotels;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateHotelRequest
 *
 * @property int $id
 * @property string $name
 * @property string $meta_title
 * @property string $meta_description
 * @property array $conditions_accommodation
 * @property string $conditions_payment
 * @property array $room_desc
 * @property array $additional_services
 * @property array $food_desc
 * @property array $contact_desc
 * @property string $site_link
 * @property array $social_links
 * @property array $aggregator_links
 * @property array $phones
 * @property integer $price
 * @property array $location
 * @property array $city
 * @property string $lat
 * @property string $lng
 * @property boolean $active
 * @property boolean $have_food_point
 * @property boolean $recommended
 * @property string $image
 * @property string $image_history
 * @property array $image_gallery
 * @property array $dictionary_ids
 */
class UpdateHotelRequest extends FormRequest
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
            'id' => 'required|int|exists:hotels,id',
            'name' => 'sometimes|array',
            'name.*' => 'string|nullable',
            'meta_title' => 'sometimes|array',
            'meta_title.*' => 'string|nullable',
            'meta_description' => 'sometimes|array',
            'meta_description.*' => 'string|nullable',
            'conditions_accommodation' => 'sometimes|array',
            'conditions_accommodation.*' => 'string|nullable',
            'conditions_payment' => 'required|string',
            'conditions_payment.*' => 'string|nullable',
            'room_desc' => 'sometimes|array',
            'room_desc.*' => 'string|nullable',
            'additional_services' => 'sometimes|array',
            'additional_services.*' => 'string|nullable',
            'contact_desc' => 'sometimes|array',
            'contact_desc.*' => 'string|nullable',
            'food_desc' => 'sometimes|array',
            'food_desc.*' => 'string|nullable',
            'active' => 'required|bool',
            'have_food_point' => 'required|bool',
            'recommended' => 'required|bool',
            'lat' => 'required|string',
            'lng' => 'required|string',
            'site_link' => 'sometimes|nullable|string',
            'social_links' => 'sometimes|nullable|array',
            'aggregator_links' => 'sometimes|nullable|array',
            'phones' => 'sometimes|nullable|array',
            'price' => 'sometimes|nullable|integer',
            'location' => 'sometimes|array',
            'location.*' => 'string|nullable',
            'city' => 'sometimes|array',
            'city.*' => 'string|nullable',
            'image' => 'required|string',
            'image_history' => 'sometimes|nullable|string',
            'image_gallery' => 'sometimes|nullable|array',
            'image_gallery.*' => 'required|string',
            'dictionary_ids'   => 'sometimes|array',
            'dictionary_ids.*' => 'integer|exists:dictionaries,id',
        ];
    }

}
