<?php

namespace App\Helpers;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;

class DateHelper
{
    private const DEFAULT_FIELD = 'created_at';

    /**
     * @param Model  $model
     * @param string $field
     *
     * @return string
     */
    public static function time(Model $model, string $field = self::DEFAULT_FIELD) : string
    {
        return $model->$field ? $model->$field->format('H:i') ?? '' : '';
    }

    /**
     * @param Model  $model
     * @param string $field
     *
     * @return string
     */
    public static function month(Model $model, string $field = self::DEFAULT_FIELD) : string
    {
        return $model->$field ? $model->$field->format('M') ?? '' : '';
    }

    /**
     * @param Model  $model
     * @param string $field
     *
     * @return string
     */
    public static function dayWeek(Model $model, string $field = self::DEFAULT_FIELD) : string
    {
        return $model->$field ? $model->$field->format('l') ?? '' : '';
    }

    /**
     * @param Model  $model
     * @param string $field
     *
     * @return string
     */
    public static function day(Model $model, string $field = self::DEFAULT_FIELD) : string
    {
        return $model->$field ? $model->$field->format('d') ?? '' : '';
    }

    /**
     * @param Model  $model
     * @param string $field
     *
     * @return string
     */
    public static function year(Model $model, string $field = self::DEFAULT_FIELD) : string
    {
        return $model->$field ? $model->$field->format('Y') ?? '' : '';
    }

    /**
     * @param Event $event
     * @return string
     */
    public static function eventRangeTime(Event $event) : string
    {
        if (! $event->date_from || ! $event->date_to) {
            return "";
        }

        return sprintf("%s-%s %s. %s",
            self::day($event, 'date_from'),
            self::day($event, 'date_to'),
            self::month($event, 'date_to'),
            self::year($event, 'date_to'),
        );
    }

}
