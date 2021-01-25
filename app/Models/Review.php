<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Review extends Model
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
    protected $fillable = [
        'approved', 'rating', 'name', 'phone',
        'email', 'body', 'allow_comments'
    ];

    /**
     * @return MorphTo
     */
    public function reviewrateable() : MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return HasMany
     */
    public function replies() : HasMany
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * @param Model $reviewrateable
     * @param array $insertData
     * @return Review
     */
    public function createRating(Model $reviewrateable, array $insertData) : Review
    {
        $review = new static();
        $review->fill($insertData);

        $reviewrateable->reviews()->save($review);

        return $review->refresh();
    }

}
