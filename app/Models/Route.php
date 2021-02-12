<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        'name', 'header_desc', 'page_desc', 'city', 'location', 'history_desc', 'contact_desc', 'life_hacks',
        'meta_title', 'meta_description', 'additional_links', 'features',
        'static_info', 'duration', 'list_points', 'what_take', 'addresses_representatives',
        'phones_representatives', 'more_info',
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'header_desc', 'page_desc', 'recommended', 'active', 'life_hacks', 'history_desc',
        'contact_desc', 'lat', 'lng', 'city', 'location', 'meta_title', 'meta_description', 'site_link',
        'additional_links', 'features', 'email',
        'static_info', 'duration', 'list_points', 'what_take', 'addresses_representatives',
        'phones_representatives', 'more_info',
    ];

    /**
     * @var string[]
     */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var string[]
     */
    protected $appends = ['image', 'image_history', 'image_gallery', 'pdf_map'];

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

    /**
     * @return mixed
     */
    public function getPdfMapAttribute()
    {
        return $this->getMedia('pdf_map')->last();
    }

}
