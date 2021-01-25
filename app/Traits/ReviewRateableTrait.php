<?php

namespace App\Traits;

use App\Models\Review;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait ReviewRateableTrait
{

    /**
     * @return MorphToMany
     */
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewrateable');
    }

    /**
     * @param int $round
     * @return int
     */
    public function averageRating(int $round = 1) : int
    {
        return (integer) $this->reviews()
            ->selectRaw('ROUND(AVG(rating), ' . $round . ') as average')
            ->whereNotNull('rating')
            ->where('approved', true)
            ->pluck('average')
            ->first();
    }

    /**
     * @return mixed
     */
    public function countRating()
    {
        return $this->reviews()
            ->where('approved', true)
            ->whereNotNull('rating')
            ->count();
    }

    /**
     * @param $inputData
     * @return Review|false
     */
    public function rating($inputData)
    {
        unset(
            $inputData['entity'],
            $inputData['entityId']
        );

        return (new Review())->createRating($this, $inputData);
    }
}
