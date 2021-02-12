<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\MorphTo;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperRoutable
 */
class Routable extends Model
{

    /**
     * @var string
     */
    protected $table = 'routables';

    /**
     * @var string[]
     */
    protected $fillable = ['order', 'routable_id', 'routable_type'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return MorphTo
     */
    public function routable()
    {
        return $this->morphTo();
    }

    /**
     * @return BelongsTo
     */
    public function route()
    {
        return $this->belongsTo(Route::class);
    }

}
