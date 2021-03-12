<?php

namespace App\Models;

use App\Traits\ReviewRateableTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Manipulations;

/**
 * Class BaseModel
 */
abstract class BaseModel extends Model implements HasMedia
{
    use HasTranslations,
        InteractsWithMedia,
        ReviewRateableTrait;

    /**
     * @var array|string[]
     */
    protected array $translatable = [];

    /**
     * @var array
     */
    protected $appends = ['image'];

    /**
     * @return array|string[]
     */
    public function getTranslatable() : array
    {
        return $this->translatable;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * @param Media|null $media
     *
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null) : void
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 200, 200);

        $this->addMediaConversion('main')
            ->fit(Manipulations::FIT_CROP, 1332, 664);

        $this->addMediaConversion('gallery')
            ->fit(Manipulations::FIT_CROP, 1107, 672);

        $this->addMediaConversion('list')
            ->fit(Manipulations::FIT_CROP, 404, 315);

        $this->addMediaConversion('near')
            ->fit(Manipulations::FIT_CROP, 560, 436);

        $this->addMediaConversion('route')
            ->fit(Manipulations::FIT_CROP, 235, 184);
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
     * @param Media $media
     *
     * @return Media
     */
    protected function fillMedia(Media $media)
    {
        $media->id = $media->getAttribute('id');
        $media->url = $media->getFullUrl();
        $media->file_name = $media->getAttribute('file_name');
        $media->thumb = $media->getUrl('thumb');

        return $media;
    }

}
