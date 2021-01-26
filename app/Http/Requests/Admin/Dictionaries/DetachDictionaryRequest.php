<?php

namespace App\Http\Requests\Admin\Dictionaries;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class DetachDictionaryRequest
 *
 * @property int $entity
 * @property int $dictionary_id
 * @property int $entity_id
 */
class DetachDictionaryRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules() : array
    {
        return [
            'entity' => 'string|' . Rule::in(['places', 'events', 'meals', 'hotels', 'routes']),
            'entity_id' => 'required|int',
            'dictionary_id' => 'required|int'
        ];
    }

}
