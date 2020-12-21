<?php

namespace App\Repositories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Helpers\SlugHelper;

class EventRepository extends Model
{

    /**
     * @return Collection
     */
    public function getListForHome() : Collection
    {
        return Event::query()
            ->oldest()
            ->limit(6)
            ->get();
    }

    /**
     * @return Collection
     */
    public function getListForSelect() : Collection
    {
        return Event::query()
            ->get()
            ->groupBy('id', true)
            ->map(function (Collection $items) {
                return $items->shift()->name;
            });
    }

    /**
     * @param Event $event
     *
     * @return array
     */
    public function getRelatedDictionaryIds(Event $event) : array
    {
        return $event
            ->dictionaries
            ->pluck('id')
            ->toArray();
    }

    /**
     * @return Collection
     */
    public function getCollectionToIndex() : Collection
    {
        return Event::query()
            ->latest()
            ->get();
    }

    /**
     * @return Collection
     */
    public function getCollectionToExport() : Collection
    {
        return Event::query()
            ->with('dictionaries')
            ->latest()
            ->get();
    }

    /**
     * @param array $data
     *
     * @return Event
     */
    public function saveEvent(array $data) : Event
    {
        $event = new Event($data);
        $event->slug = SlugHelper::generate(new Event(), $data['name']);
        $event->save();

        return $event->refresh();
    }

    /**
     * @param array    $data
     * @param Event $event
     *
     * @return Event
     */
    public function updateData(array $data, Event $event) : Event
    {
        $event->slug = SlugHelper::generate(new Event(), $data['name']);
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
        Event::query()
            ->whereIn('id', $ids)
            ->get()
            ->each(function (Event $event) {
                $event->delete();
            });
    }

}
