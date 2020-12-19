<?php

namespace App\Http\Requests\Admin\Vars;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateVarRequest
 *
 * @property int $id
 * @property string $val_ru
 * @property string $val_en
 */
class UpdateVarRequest extends FormRequest
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
            'id' => 'required|int|exists:vars,id',
            'val_ru' => 'sometimes|string|nullable',
            'val_en' => 'sometimes|string|nullable',
        ];
    }

}
