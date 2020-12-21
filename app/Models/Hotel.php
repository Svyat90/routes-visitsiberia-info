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
 * @property boolean $active
 * @property boolean $recommended
 * @property string $name
 * @property string $meta_title
 * @property string $meta_description
 * @property string $conditions_accommodation
 * @property string $conditions_payment
 * @property string $room_desc
 * @property string $additional_services
 * @property string $food_desc
 * @property string $contact_desc
 * @property string $site_link
 * @property string $social_links
 * @property string $aggregator_links
 * @property string $phones
 * @property string $location
 * @property string $lat
 * @property string $lng
 * @property Media $image
 * @property Media $image_history
 * @property MediaCollection $image_gallery
 * @property Collection $dictionaries
 */
class Hotel extends BaseModel
{
    /**
     * @var array|string[]
     */
    public array $translatable = [
        'name', 'meta_title', 'meta_description',
        'conditions_accommodation', 'conditions_payment',
        'room_desc', 'additional_services','food_desc',
        'contact_desc', 'location',
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'active', 'recommended', 'name', 'meta_title', 'meta_description',
        'conditions_accommodation', 'conditions_payment', 'room_desc', 'additional_services',
        'food_desc', 'contact_desc', 'site_link', 'social_links', 'aggregator_links',
        'phones', 'location', 'lat', 'lng',
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
        return $this->belongsToMany(Dictionary::class, 'hotel_dictionary', 'hotel_id', 'dictionary_id');
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
