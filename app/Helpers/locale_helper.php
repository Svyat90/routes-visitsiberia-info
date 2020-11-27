<?php

use Illuminate\Database\Eloquent\Model;

if (! function_exists('localeColumn')) {

    /**
     * @param string $column
     * @return string
     */
    function localeColumn(string $column) : string
    {
        return sprintf("%s_%s", $column, app()->getLocale());
    }

}

if (! function_exists('columnTrans')) {

    /**
     * @param Model $model
     * @param string $column
     * @return string
     */
    function columnTrans(Model $model, string $column) : string
    {
        $locales = $model->getTranslations($column);

        return $locales[app()->getLocale()];
    }

}

if (! function_exists('isTranslable')) {

    /**
     * @param Model $model
     * @param string $column
     * @return bool
     */
    function isTranslable(Model $model, string $column) : bool
    {
        return in_array($column, $model->translatable ?? []);
    }

}
