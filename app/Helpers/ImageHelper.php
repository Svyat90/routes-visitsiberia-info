<?php

namespace App\Helpers;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ImageHelper
{

    /**
     * @param Media|null $media
     *
     * @return string
     */
    public static function thumbImage(? Media $media) : string
    {
        return $media
            ? sprintf('<img src="%s" />', $media->getFullUrl('thumb'))
            : '';
    }

    /**
     * @param string|null $path
     * @param string      $width
     *
     * @return string
     */
    public static function image(? string $path, string $width = '')
    {
        $styles = '';
        if ($width) {
            $styles = 'style="width: ' . $width . 'px;"';
        }

        return sprintf(
            '<img src="%s/storage/%s" %s />',
            config('app.url'),
            $path,
            $styles
        );
    }

}
