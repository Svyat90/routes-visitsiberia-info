<?php

namespace App\Http\Requests\Languages;

use App\Services\LanguageService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class LanguageEditRequest
 * @property string $locale
 */
class StoreLanguageRequest extends FormRequest
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
     * @param LanguageService $service
     * @return \string[][]
     */
    public function rules(LanguageService $service)
    {
        return [
            'locale' => [
                'required',
                'string',
                Rule::in($service->getAvailableLocales())
            ]
        ];
    }
}
