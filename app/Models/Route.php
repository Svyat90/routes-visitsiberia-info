<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Place
 *
 * @mixin IdeHelperRoute
 */
class Route extends BaseModel
{

    /**
     * @var array|string[]
     */
    public array $translatable = [
        'name', 'page_desc', 'location', 'history_desc', 'contact_desc', 'life_hacks', 'city',
        'features_desc', 'statistic_info_desc', 'duration', 'list_points', 'what_take', 'more_info',
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'page_desc', 'active', 'with_children', 'walking_route', 'available_for_invalids',
        'can_by_car', 'life_hacks', 'history_desc', 'contact_desc', 'lat', 'lng', 'location',
        'site_link', 'features_desc', 'email', 'statistic_info_desc', 'duration', 'list_points',
        'what_take', 'more_info', 'city'
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
    public function dictionaries()
    {
        return $this->belongsToMany(Dictionary::class, 'route_dictionary', 'route_id', 'dictionary_id');
    }

    public function routables()
    {
        return $this->hasMany(Routable::class);
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
