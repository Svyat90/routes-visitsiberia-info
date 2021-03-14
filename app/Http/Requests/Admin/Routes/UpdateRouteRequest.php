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
 * @property array $features_desc
 * @property array $statistic_info_desc
 * @property array $duration
 * @property array $list_points
 * @property array $what_take
 * @property array $more_info
 * @property array $social_links
 * @property array $addresses
 * @property array $additional_links
 * @property array $link_phones
 * @property boolean $active
 * @property boolean $recommended
 * @property string $image
 * @property array $image_gallery
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
            'page_desc' => 'sometimes|array',
            'page_desc.*' => 'string|nullable',
            'history_desc' => 'sometimes|array',
            'history_desc.*' => 'string|nullable',
            'contact_desc' => 'sometimes|array',
            'contact_desc.*' => 'string|nullable',
            'life_hacks' => 'sometimes|array',
            'life_hacks.*' => 'string|nullable',
            'active' => 'required|bool',
            'with_children' => 'required|bool',
            'walking_route' => 'required|bool',
            'available_for_invalids' => 'required|bool',
            'can_by_car' => 'required|bool',
            'lat' => 'required|string',
            'lng' => 'required|string',
            'email' => 'sometimes|nullable|string',
            'location' => 'sometimes|array',
            'location.*' => 'string|nullable',
            'features_desc' => 'sometimes|array',
            'features_desc.*' => 'string|nullable',
            'statistic_info_desc' => 'sometimes|array',
            'statistic_info_desc.*' => 'string|nullable',
            'duration' => 'sometimes|array',
            'duration.*' => 'string|nullable',
            'list_points' => 'sometimes|array',
            'list_points.*' => 'string|nullable',
            'what_take' => 'sometimes|array',
            'what_take.*' => 'string|nullable',
            'more_info' => 'sometimes|array',
            'more_info.*' => 'string|nullable',
            'site_link' => 'sometimes|nullable|string',
            'social_links' => 'sometimes|nullable|array',
            'addresses' => 'sometimes|nullable|array',
            'additional_links' => 'sometimes|nullable|array',
            'link_phones' => 'sometimes|nullable|array',
            'image' => 'required|string',
            'image_gallery' => 'sometimes|nullable|array',
            'image_gallery.*' => 'required|string',
            'dictionary_ids'   => 'sometimes|array',
            'dictionary_ids.*' => 'integer|exists:dictionaries,id',
            'routable_ids'   => 'sometimes|array',
            'routable_ids.*' => 'string',
        ];
    }

}
