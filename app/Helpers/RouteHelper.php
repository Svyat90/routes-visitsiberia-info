<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Support\Str;

class RouteHelper
{

    /**
     * @param Model $model
     * @return string
     */
    public static function show(Model $model) : string
    {
        $namespace = self::namespace($model);

        return route('front.' . $namespace . '.show', $model->id);
    }

    /**
     * @param Model $model
     * @return string
     */
    public static function namespace(Model $model) : string
    {
        return strtolower(Str::plural(class_basename($model)));
    }

    /**
     * @param Model $model
     * @return string
     */
    public static function model(Model $model) : string
    {
        return strtolower(class_basename($model));
    }

    /**
     * @param Model $model
     * @return string
     */
    public static function showAdmin(Model $model) : string
    {
        $namespace = self::namespace($model);

        return route('admin.' . $namespace . '.show', $model->id);
    }

    /**
     * @param Model $model
     * @return string
     */
    public static function editAdmin(Model $model) : string
    {
        $namespace = self::namespace($model);

        return route('admin.' . $namespace . '.edit', $model->id);
    }
}
