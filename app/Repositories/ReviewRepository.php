<?php

namespace App\Repositories;

use App\Models\Review;
use App\Models\Reply;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ReviewRepository extends Model
{

    /**
     * @return Collection
     */
    public function getCollectionToIndex() : Collection
    {
        return Review::query()
            ->latest()
            ->get();
    }

    /**
     * @param Review $review
     * @param array $data
     * @return Reply
     */
    public function saveReply(Review $review, array $data) : Model
    {
        $data['name'] = 'Admin';
        $data['approved'] = true;
        $data['is_admin'] = true;

        $reply = $review->replies()->create($data);

        return $reply->refresh();
    }

    /**
     * @param array    $data
     * @param Review $event
     *
     * @return Review
     */
    public function updateData(array $data, Review $event) : Review
    {
        $event->update($data);

        return $event->refresh();
    }

    /**
     * @param array $ids
     *
     * @throws \Exception
     */
    public function deleteIds(array $ids) : void
    {
        Review::query()
            ->whereIn('id', $ids)
            ->get()
            ->each(function (Review $event) {
                $event->delete();
            });
    }

}
