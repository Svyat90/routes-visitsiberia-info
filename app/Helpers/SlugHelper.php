<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;

class SlugHelper
{

    /**
     * @param Model $model
     * @param array $nameArr
     *
     * @return string
     */
    public static function generate(Model $model, array $nameArr = []) : string
    {
        if (! empty($nameArr)) {
            $slug = "";
            foreach ($nameArr as $locale => $name) {
                if ($locale === App::getLocale() && $name) {
                    $slug = self::generateUniqueSlug($model, $name);
                }
            }

            if (! $slug) {
                foreach ($nameArr as $locale => $name) {
                    if ($name) {
                        $slug = self::generateUniqueSlug($model, $name);
                    }
                }
            }

            if ($slug) {
                return Str::slug($slug, "-", app()->getLocale());
            }
        }

        return self::getDefaultSlug($model);
    }

    /**
     * @param Model  $model
     * @param string $slug
     * @param int    $count
     *
     * @return string
     */
    private static function generateUniqueSlug(Model $model, string $slug, $count = 0)
    {
        if ($model::query()->where('slug', '=', $slug)->count() > 0) {
            return self::generateUniqueSlug($model, $slug . '=' . ++$count, $count);
        }

        return $count ? $slug . '-' . $count : $slug;
    }

    /**
     * @param Model $model
     *
     * @return string
     */
    private static function getDefaultSlug(Model $model)
    {
        return Str::slug(
            Str::camel(get_class($model)) . " " .  Str::random(5),
            '-',
            app()->getLocale()
        );
    }

}
