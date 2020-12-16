<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Page
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property string $title
 * @property string $meta_title
 * @property string $title_description
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
    public function getRouteKey()
    {
        return 'slug';
    }

}
