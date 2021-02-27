<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\MorphTo;

class SocialField extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'url', 'title', 'type', 'field'
    ];

    /**
     * @return MorphTo
     */
    public function sociable() : MorphTo
    {
        return $this->morphTo();
    }

}
