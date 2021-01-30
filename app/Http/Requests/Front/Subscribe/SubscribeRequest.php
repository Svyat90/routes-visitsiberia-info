<?php

namespace App\Http\Requests\Front\Subscribe;

use Illuminate\Foundation\Http\FormRequest;

class SubscribeRequest extends FormRequest
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
            'email' => 'required|max:128|email|unique:subscribers,email',
        ];
    }
}
