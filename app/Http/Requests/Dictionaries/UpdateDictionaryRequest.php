<?php

namespace App\Http\Requests\Dictionaries;

use App\Services\DictionaryService;
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
            'name_ru' => 'required|nullable|max:128',
            'name_en' => 'sometimes|nullable|max:128',
            'hidden' => 'required|bool',
            'dictionary_id' => 'sometimes|int',
            'date_range' => [
                $this->type === DictionaryService::TYPE_SEASON ? 'required' : 'sometimes',
                'string'
            ],
        ];
    }

}
