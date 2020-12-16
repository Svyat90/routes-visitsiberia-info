<?php

namespace App\Http\Requests\Admin\Pages;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdatePageRequest
 *
 * @property array $name
 * @property array $title
 * @property array $meta_title
 * @property array $title_description
 */
class UpdatePageRequest extends FormRequest
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
            'name.*' => 'string|nullable|max:128',
            'title' => 'sometimes|array',
            'title.*' => 'string|nullable|max:128',
            'meta_title' => 'sometimes|array',
            'meta_title.*' => 'string|nullable|max:128',
            'title_description' => 'sometimes|array',
            'title_description.*' => 'string|nullable|max:128',
        ];
    }

}
