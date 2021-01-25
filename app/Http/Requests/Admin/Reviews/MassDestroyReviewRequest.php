<?php

namespace App\Http\Requests\Admin\Reviews;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class MassDestroyReviewRequest
 *
 * @property array $ids
 */
class MassDestroyReviewRequest extends FormRequest
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
    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:reviews,id',
        ];
    }

}
