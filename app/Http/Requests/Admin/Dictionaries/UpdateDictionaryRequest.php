<?php

namespace App\Http\Requests\Admin\Dictionaries;

use App\Services\DictionaryService;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateDictionaryRequest
 * @property string $parent_type
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
                $this->parent_type === DictionaryService::TYPE_SEASON ? 'required' : 'sometimes',
                'string'
            ],
        ];
    }

}
