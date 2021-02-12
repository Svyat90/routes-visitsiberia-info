<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Place
 *
 * @mixin IdeHelperEvent
 */
class Event extends BaseModel
{
    /**
     * @var array|string[]
     */
    public array $translatable = [
        'name', 'page_desc', 'city', 'location',
        'history_desc', 'contact_desc', 'life_hacks',
        'meta_title', 'meta_description', 'phones_representatives',
        'addresses_representatives',
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'page_desc', 'recommended', 'active', 'life_hacks',
        'history_desc', 'contact_desc', 'lat', 'lng', 'city', 'location', 'phones_representatives',
        'meta_title', 'meta_description', 'site_link', 'additional_links',
        'have_camping', 'addresses_representatives', 'date_from', 'date_to',
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
        'image', 'image_history', 'image_gallery'
    ];

    /**
     * @var string[]
     */
    protected $dates = [
        'date_from', 'date_to'
    ];

    /**
     * @return BelongsToMany
     */
    public function dictionaries()
    {
        return $this->belongsToMany(Dictionary::class, 'event_dictionary', 'event_id', 'dictionary_id');
    }

    public function routable()
    {
        return $this->morphMany(Routable::class, 'routable');
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
