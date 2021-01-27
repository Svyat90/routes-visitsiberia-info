<?php

namespace App\Http\Requests\Admin\Routes;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateRouteRequest
 *
 * @property int $id
 * @property array $name
 * @property string $meta_title
 * @property string $meta_description
 * @property array $header_desc
 * @property array $page_desc
 * @property array $history_desc
 * @property array $contact_desc
 * @property array $location
 * @property array $city
 * @property array $features
 * @property array $static_info
 * @property array $duration
 * @property array $list_points
 * @property array $what_take
 * @property array $addresses_representatives
 * @property array $phones_representatives
 * @property array $more_info
 * @property array $additional_links
 * @property boolean $active
 * @property boolean $recommended
 * @property string $image
 * @property string $image_history
 * @property array $image_gallery
 * @property string $pdf_map
 * @property array $dictionary_ids
 * @property array $routable_ids
 */
class UpdateRouteRequest extends FormRequest
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
            'id' => 'required|int|exists:routes,id',
            'name' => 'sometimes|array',
            'name.*' => 'string|nullable',
            'meta_title' => 'sometimes|array',
            'meta_title.*' => 'string|nullable',
            'meta_description' => 'sometimes|array',
            'meta_description.*' => 'string|nullable',
            'header_desc' => 'sometimes|array',
            'header_desc.*' => 'string|nullable',
            'page_desc' => 'sometimes|array',
            'page_desc.*' => 'string|nullable',
            'history_desc' => 'sometimes|array',
            'history_desc.*' => 'string|nullable',
            'contact_desc' => 'sometimes|array',
            'contact_desc.*' => 'string|nullable',
            'life_hacks' => 'sometimes|array',
            'life_hacks.*' => 'string|nullable',
            'active' => 'required|bool',
            'recommended' => 'required|bool',
            'lat' => 'required|string',
            'lng' => 'required|string',
            'email' => 'sometimes|nullable|string',
            'location' => 'sometimes|array',
            'location.*' => 'string|nullable',
            'city' => 'sometimes|array',
            'city.*' => 'string|nullable',
            'features' => 'sometimes|array',
            'features.*' => 'string|nullable',
            'static_info' => 'sometimes|array',
            'static_info.*' => 'string|nullable',
            'duration' => 'sometimes|array',
            'duration.*' => 'string|nullable',
            'list_points' => 'sometimes|array',
            'list_points.*' => 'string|nullable',
            'what_take' => 'sometimes|array',
            'what_take.*' => 'string|nullable',
            'addresses_representatives' => 'sometimes|array',
            'addresses_representatives.*' => 'string|nullable',
            'phones_representatives' => 'sometimes|array',
            'phones_representatives.*' => 'string|nullable',
            'more_info' => 'sometimes|array',
            'more_info.*' => 'string|nullable',
            'additional_links' => 'sometimes|array',
            'additional_links.*' => 'string|nullable',
            'image' => 'required|string',
            'image_history' => 'sometimes|nullable|string',
            'image_gallery' => 'sometimes|nullable|array',
            'image_gallery.*' => 'required|string',
            'pdf_map' => 'sometimes|nullable|string',
            'dictionary_ids'   => 'sometimes|array',
            'dictionary_ids.*' => 'integer|exists:dictionaries,id',
            'routable_ids'   => 'sometimes|array',
            'routable_ids.*' => 'string',
        ];
    }

}
