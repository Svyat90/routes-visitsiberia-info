<?php

namespace App\Http\Requests\Admin\Dictionaries;

use Illuminate\Foundation\Http\FormRequest;

class StoreDictionaryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|array',
            'name.*' => 'string|nullable|max:128',
            'hidden' => 'required|bool',
            'dictionary_id' => 'sometimes|int',
        ];
    }
}
