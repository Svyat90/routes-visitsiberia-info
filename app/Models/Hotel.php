<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Place
 *
 * @mixin IdeHelperHotel
 */
class Hotel extends BaseModel
{
    /**
     * @var array|string[]
     */
    public array $translatable = [
        'name', 'meta_title', 'meta_description', 'description',
        'conditions_accommodation', 'conditions_payment',
        'room_desc', 'additional_services','food_desc',
        'contact_desc', 'city', 'location'
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'active', 'recommended', 'name', 'meta_title', 'meta_description',
        'conditions_accommodation', 'conditions_payment', 'room_desc', 'additional_services',
        'food_desc', 'contact_desc', 'site_link', 'social_links', 'aggregator_links',
        'phones', 'city', 'location', 'lat', 'lng', 'description', 'price',
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
