<?php

namespace App\Http\Requests\Front\Reviews;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class ReviewStoreRequest
 * @property string $entity
 * @property int $entityId
 * @property int $rating
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $body
 */
class ReviewStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        $entities = ['routes', 'places', 'events', 'hotels', 'meals'];

        return [
            'entity' => ['required', Rule::in($entities)],
            'entityId' => 'required|int' . $this->getExistsIdString(),
            'rating' => 'required|int|min:1|max:5',
            'name' => 'required|string|max:256',
            'phone' => 'required|string|max:256',
            'email' => 'required|string|max:256',
            'body' => 'required|string|max:500',
        ];
    }

    /**
     * @return string
     */
    private function getExistsIdString() : string
    {
        switch ($this->entity) {
            case 'routes':
                return "|exists:routes,id";
            case 'places':
                return "|exists:places,id";
            case 'events':
                return "|exists:events,id";
            case 'hotels':
                return "|exists:hotels,id";
            case 'meals':
                return "|exists:meals,id";
            default:
                return "";
        }
    }
}
