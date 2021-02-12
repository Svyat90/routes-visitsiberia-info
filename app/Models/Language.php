<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Language
 *
 * @mixin IdeHelperLanguage
 */
class Language extends Model
{
    /**
     * @var string
     */
    protected $table = 'languages';

    /**
     * @var string[]
     */
    protected $fillable = [
        'locale', 'active'
    ];

    /**"
     * @var string[]
     */
    protected $casts = [
        'active' => 'bool'
    ];

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

}
