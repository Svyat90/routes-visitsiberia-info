<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Place
 *
 * @mixin IdeHelperPlace
 */
class Place extends BaseModel
{

    /**
     * @var array|string[]
     */
    public array $translatable = [
        'name', 'page_desc', 'location', 'history_desc',
        'life_hacks', 'contact_desc', 'city'
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'page_desc', 'recommended', 'active', 'life_hacks',
        'contact_desc', 'lat', 'lng', 'location', 'history_desc', 'city'
    ];

    /**
     * @var string[]
     */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var string[]
     */
    protected $appends = ['image', 'image_gallery'];

    /**
     * @return BelongsToMany
     */
    public function dictionaries() : BelongsToMany
    {
        return $this->belongsToMany(Dictionary::class, 'place_dictionary', 'place_id', 'dictionary_id');
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
