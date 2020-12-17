<?php

namespace App\Http\Requests\Admin\Dictionaries;

use App\Services\PlaceService;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateDictionaryRequest
 * @property string $type
 */
class UpdateDictionaryRequest extends FormRequest
{
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
            'name' => 'required|array',
            'name.*' => 'string|nullable|max:128',
            'hidden' => 'required|bool',
            'dictionary_id' => 'sometimes|int',
            'date_range' => [
                $this->type === PlaceService::TYPE_SEASON ? 'required' : 'sometimes',
                'string'
            ],
        ];
    }

}
