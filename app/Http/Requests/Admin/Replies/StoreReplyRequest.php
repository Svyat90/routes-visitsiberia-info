<?php

namespace App\Http\Requests\Admin\Replies;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreReplyRequest
 *
 * @property int $review_id
 * @property string $body
 */
class StoreReplyRequest extends FormRequest
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
            'review_id' => 'required|int|exists:reviews,id',
            'body' => 'required|string'
        ];
    }

}
