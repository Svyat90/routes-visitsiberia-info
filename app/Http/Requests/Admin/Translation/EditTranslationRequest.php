<?php

namespace App\Http\Requests\Admin\Translation;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TranslationEditRequest
 * @property string $path
 */
class EditTranslationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'path' => 'required|string'
        ];
    }
}
