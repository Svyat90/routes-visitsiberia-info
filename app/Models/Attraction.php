<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Attraction extends Model
{
    use HasFactory, HasTranslations;

    /**
     * @var array|string[]
     */
    public array $translatable = [
        'name'
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'lat', 'lng'
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
        'image'
    ];

    public function getImageAttribute()
    {
        return asset('front/img/Tepsey-img1.png');
    }

    public function getNameAttribute()
    {
        return columnTrans($this, 'name');
    }

}
