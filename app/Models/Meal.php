<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Event
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property string $header_desc
 * @property string $page_desc
 * @property string $helpful_info
 * @property string $history_desc
 * @property string $contact_desc
 * @property string $lat
 * @property string $lng
 * @property string $location
 * @property boolean $active
 * @property boolean $recommended
 * @property Media $image
 * @property Media $image_history
 * @property MediaCollection $image_gallery
 * @property Collection $dictionaries
 */
class Meal extends BaseModel
{
    /**
     * @var array|string[]
     */
    public array $translatable = [
        'name', 'header_desc', 'page_desc', 'location',
        'helpful_info', 'history_desc', 'contact_desc',
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'header_desc', 'page_desc', 'recommended', 'active',
        'helpful_info', 'history_desc', 'contact_desc', 'lat', 'lng', 'location'
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * @var string[]
     */
    protected $appends = [
        'image', 'image_history'
    ];

    /**
     * @return BelongsToMany
     */
    public function dictionaries()
    {
        return $this->belongsToMany(Dictionary::class, 'meal_dictionary', 'meal_id', 'dictionary_id');
    }

    /**
     * @return Media|null
     */
    public function getImageAttribute()
    {
        if (! $media = $this->getMedia('image')->last()) {
            return null;
        }

        return $this->fillMedia($media);
    }

    /**
     * @return Media|null
     */
    public function getImageHistoryAttribute()
    {
        if (! $media = $this->getMedia('image_history')->last()) {
            return null;
        }

        return $this->fillMedia($media);
    }

    /**
     * @return Collection|null
     */
    public function getImageGalleryAttribute()
    {
        if (! $mediaCollect = $this->getMedia('image_gallery')) {
            return null;
        }

        return $mediaCollect->map(function (Media $media) {
            return $this->fillMedia($media);
        });
    }

}
