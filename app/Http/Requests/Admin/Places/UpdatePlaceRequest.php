<?php

namespace App\Http\Requests\Admin\Places;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdatePlaceRequest
 *
 * @property int $id
 * @property array $name
 * @property array $location
 * @property array $page_desc
 * @property array $history_desc
 * @property array $contact_desc
 * @property boolean $active
 * @property string $site_link
 * @property array $social_links
 * @property array $additional_links
 * @property array $link_phones
 * @property string $image
 * @property array $image_gallery
 * @property array $dictionary_ids
 */
class UpdatePlaceRequest extends FormRequest
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
            'id' => 'required|int|exists:places,id',
            'name' => 'sometimes|array',
            'name.*' => 'string|nullable',
            'page_desc' => 'sometimes|array',
            'page_desc.*' => 'string|nullable',
            'history_desc' => 'sometimes|array',
            'history_desc.*' => 'string|nullable',
            'contact_desc' => 'sometimes|array',
            'contact_desc.*' => 'string|nullable',
            'life_hacks' => 'sometimes|array',
            'life_hacks.*' => 'string|nullable',
            'active' => 'required|bool',
            'lat' => 'required|string',
            'lng' => 'required|string',
            'location' => 'sometimes|array',
            'location.*' => 'string|nullable',
            'site_link' => 'sometimes|nullable|string',
            'social_links' => 'sometimes|nullable|array',
            'additional_links' => 'sometimes|nullable|array',
            'link_phones' => 'sometimes|nullable|array',
            'image' => 'required|string',
            'image_gallery' => 'sometimes|nullable|array',
            'image_gallery.*' => 'required|string',
            'dictionary_ids'   => 'sometimes|array',
            'dictionary_ids.*' => 'integer|exists:dictionaries,id',
        ];
    }

}
