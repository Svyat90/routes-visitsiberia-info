<?php

namespace App\Http\Requests\Admin\Reviews;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdatePlaceRequest
 *
 * @property int $id
 * @property boolean approved
 */
class UpdateReviewRequest extends FormRequest
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
            'id' => 'required|int|exists:reviews,id',
            'approved' => 'required|bool',
        ];
    }

}
