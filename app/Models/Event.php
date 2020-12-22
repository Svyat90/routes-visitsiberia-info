<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Place
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property string $page_desc
 * @property string $history_desc
 * @property string $contact_desc
 * @property string $life_hacks
 * @property string $lat
 * @property string $lng
 * @property string $location
 * @property string $site_link
 * @property string $additional_links
 * @property string $phones_representatives
 * @property string $addresses_representatives
 * @property boolean $active
 * @property boolean $recommended
 * @property Media $image
 * @property Media $image_history
 * @property MediaCollection $image_gallery
 * @property Collection $dictionaries
 */
class Event extends BaseModel
{
    /**
     * @var array|string[]
     */
    public array $translatable = [
        'name', 'page_desc', 'location',
        'history_desc', 'contact_desc', 'life_hacks',
        'meta_title', 'meta_description', 'phones_representatives',
        'addresses_representatives',
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'page_desc', 'recommended', 'active', 'life_hacks',
        'history_desc', 'contact_desc', 'lat', 'lng', 'location', 'phones_representatives',
        'meta_title', 'meta_description', 'site_link', 'additional_links',
        'have_camping', 'addresses_representatives',
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
