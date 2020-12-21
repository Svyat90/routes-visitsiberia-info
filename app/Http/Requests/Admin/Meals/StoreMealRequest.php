<?php

namespace App\Http\Requests\Admin\Meals;

use Illuminate\Foundation\Http\FormRequest;

class StoreMealRequest extends FormRequest
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
            'working_hours' => 'sometimes|array',
            'working_hours.*' => 'string|nullable',
            'active' => 'required|bool',
            'recommended' => 'required|bool',
            'have_breakfasts' => 'required|bool',
            'have_business_lunch' => 'required|bool',
            'delivery_available' => 'required|bool',
            'site_link' => 'sometimes|nullable|string',
            'social_links' => 'sometimes|nullable|string',
            'phones' => 'sometimes|nullable|string',
            'lat' => 'required|string',
            'lng' => 'required|string',
            'location' => 'sometimes|array',
            'location.*' => 'string|nullable',
            'image' => 'required|string',
            'image_history' => 'sometimes|nullable|string',
            'image_gallery' => 'sometimes|nullable|array',
            'image_gallery.*' => 'required|string',
            'dictionary_ids'   => 'sometimes|array',
            'dictionary_ids.*' => 'integer|exists:dictionaries,id',
        ];
    }

}
