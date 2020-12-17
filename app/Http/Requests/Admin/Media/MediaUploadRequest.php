<?php

namespace App\Http\Requests\Admin\Media;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class MediaUploadRequest
 *
 * @property string $size
 * @property string $width
 * @property string $height
 */
class MediaUploadRequest extends FormRequest
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
        $rules = [];

        // Validates file size
        if ($this->has('size')) {
            $rules['file'] = 'max:' . $this->size * 1024;
        }

        // If width or height is preset - we are validating it as an image
        if ($this->has('width') || $this->has('height')) {
            $rules['file'] = sprintf(
                'image|dimensions:max_width=%s,max_height=%s',
                $this->input('width', 100000),
                $this->input('height', 100000)
            );
        }

        return $rules;
    }
}
