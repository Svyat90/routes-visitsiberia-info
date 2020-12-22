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
 * @property string $header_desc
 * @property string $page_desc
 * @property string $history_desc
 * @property string $contact_desc
 * @property string $life_hacks
 * @property string $lat
 * @property string $lng
 * @property string $location
 * @property string $phones
 * @property string $working_hours
 * @property string $site_link
 * @property string $social_links
 * @property string $contacts_representatives
 * @property string $additional_links
 * @property boolean $active
 * @property boolean $recommended
 * @property boolean $have_breakfasts
 * @property boolean $have_business_lunch
 * @property boolean $delivery_available
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
        'name', 'page_desc', 'location', 'history_desc', 'working_hours',
        'contact_desc', 'meta_title', 'meta_description',
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'page_desc', 'recommended', 'active', 'have_breakfasts',
        'have_business_lunch', 'delivery_available', 'working_hours',
        'contact_desc', 'lat', 'lng', 'location', 'history_desc', 'phones',
        'meta_title', 'meta_description', 'site_link', 'social_links', 'aggregator_links'
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
     * @return BelongsToMany
     */
    public function dictionaries()
    {
        return $this->belongsToMany(Dictionary::class, 'place_dictionary', 'place_id', 'dictionary_id');
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
