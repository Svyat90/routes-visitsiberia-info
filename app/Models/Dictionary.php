<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Dictionary
 * @property $children
 * @property $parent
 */
class Dictionary extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    public $table = 'dictionaries';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name_ru', 'name_en', 'type', 'hidden'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'hidden' => 'boolean'
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
}
