<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Collection;
use \Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Class Hotel
 *
 * @mixin IdeHelperHotel
 */
class Hotel extends BaseModel
{
    /**
     * @var array|string[]
     */
    public array $translatable = [
        'name', 'description', 'rooms_fund', 'conditions_accommodation',
        'additional_services', 'contact_desc', 'location', 'city'
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'active', 'recommended', 'name', 'city',
        'conditions_accommodation', 'conditions_payment',
        'contact_desc', 'site_link', 'additional_services',
        'location', 'lat', 'lng', 'description', 'have_food_point'
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
        'image', 'image_gallery'
    ];

    /**
     * @return BelongsToMany
     */
    public function dictionaries() : BelongsToMany
    {
        return $this->belongsToMany(Dictionary::class, 'hotel_dictionary', 'hotel_id', 'dictionary_id');
    }

    /**
     * @return MorphMany
     */
    public function routable() : MorphMany
    {
        return $this->morphMany(Routable::class, 'routable');
    }

    /**
     * @return MorphMany
     */
    public function socialFields() : MorphMany
    {
        return $this->morphMany(SocialField::class, 'sociable');
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
