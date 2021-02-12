<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperReply
 */
class Reply extends Model
{
    /**
     * @var array
     */
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    /**
     * @var string[]
     */
    protected $fillable = ['name', 'approved', 'body', 'is_admin'];

    /**
     * @return BelongsTo
     */
    public function review() : BelongsTo
    {
        return $this->belongsTo(Review::class);
    }

}
