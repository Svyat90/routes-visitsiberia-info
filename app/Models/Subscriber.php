<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperSubscriber
 */
class Subscriber extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'email'
    ];

}
