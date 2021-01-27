<?php

namespace App\Http\Requests\Admin\Events;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StorePlaceRequest
 *
 * @property array $name
 * @property array $location
 * @property array $city
 * @property string $meta_title
 * @property string $meta_description
 * @property array $page_desc
 * @property array $history_desc
 * @property array $contact_desc
 * @property boolean $active
 * @property boolean $have_camping
 * @property string $image
 * @property string $image_history
 * @property array $image_gallery
 * @property array $dictionary_ids
 */
class StoreEventRequest extends FormRequest
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
            'meta_title' => 'sometimes|array',
            'meta_title.*' => 'string|nullable',
            'meta_description' => 'sometimes|array',
            'meta_description.*' => 'string|nullable',
            'page_desc' => 'sometimes|array',
            'page_desc.*' => 'string|nullable',
            'history_desc' => 'sometimes|array',
            'history_desc.*' => 'string|nullable',
            'contact_desc' => 'sometimes|array',
            'contact_desc.*' => 'string|nullable',
            'life_hacks' => 'sometimes|array',
            'life_hacks.*' => 'string|nullable',
            'active' => 'required|bool',
            'have_camping' => 'required|bool',
            'lat' => 'required|string',
            'lng' => 'required|string',
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
