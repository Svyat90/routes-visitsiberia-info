<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Dictionary
 *
 * @property $children
 * @property $parent
 */
class Dictionary extends BaseModel
{
    use SoftDeletes;

    /**
     * @var array|string[]
     */
    public array $translatable = [
        'name'
    ];

    /**
     * @var string
     */
    public $table = 'dictionaries';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'type', 'hidden',
        'date_range_from', 'date_range_to'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'hidden' => 'boolean',
        'date_range_from' => 'datetime',
        'date_range_to' => 'datetime'
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'parent_id', 'hidden', 'date_range_from', 'date_range_to',
        'created_at', 'updated_at', 'deleted_at', 'type'
    ];

    /**
     * @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Dictionary::class, 'parent_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany(Dictionary::class, 'parent_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function places()
    {
        return $this->belongsToMany(Place::class, 'place_dictionary', 'dictionary_id', 'place_id');
    }

}
