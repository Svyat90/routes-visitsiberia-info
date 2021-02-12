<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Page
 *
 * @mixin IdeHelperPage
 */
class Page extends BaseModel
{
    use SoftDeletes;

    /**
     * @var string
     */
    public $table = 'pages';

    /**
     * @var array|string[]
     */
    public array $translatable = [
        'name', 'title', 'meta_title', 'meta_description'
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'title', 'meta_title', 'meta_description'
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKey() : string
    {
        return 'slug';
    }

}
