<?php

namespace App\Repositories;

use App\Models\Route;
use Illuminate\Support\Collection;
use App\Helpers\SlugHelper;
use App\Models\Routable;

class RouteRepository extends BaseRepository
{

    /**
     * @return Collection
     */
    public function getListForHome() : Collection
    {
        return Route::query()
            ->latest()
            ->limit(4)
            ->get();
    }

    /**
     * @return Collection
     */
    public function getListForSelect() : Collection
    {
        return Route::query()
            ->get()
            ->groupBy('id', true)
            ->map(function (Collection $items) {
                return $items->shift()->name;
            });
    }

    /**
     * @param Route $route
     *
     * @return array
     */
    public function getRelatedDictionaryIds(Route $route) : array
    {
        return $route
            ->dictionaries
            ->pluck('id')
            ->toArray();
    }

    /**
     * @return Collection
     */
    public function getCollectionToIndex() : Collection
    {
        return Route::query()
            ->latest()
            ->get();
    }

    /**
     * @return Collection
     */
    public function getCollectionToExport() : Collection
    {
        return Route::query()
            ->with('dictionaries')
            ->latest()
            ->get();
    }

    /**
     * @param array $data
     *
     * @return Route
     */
    public function saveRoute(array $data) : Route
    {
        $route = new Route($data);
        $route->slug = SlugHelper::generate(new Route(), $data['name']);
        $route->save();

        return $route->refresh();
    }

    /**
     * @param array    $data
     * @param Route $route
     *
     * @return Route
     */
    public function updateData(array $data, Route $route) : Route
    {
        $route->slug = SlugHelper::generate(new Route(), $data['name']);
        $route->update($data);

        return $route->refresh();
    }

    /**
     * @param array $ids
     *
     * @throws \Exception
     */
    public function deleteIds(array $ids) : void
    {
        Route::query()
            ->whereIn('id', $ids)
            ->get()
            ->each(function (Route $route) {
                $route->delete();
            });
    }

    /**
     * @param Route $route
     *
     * @return Collection
     */
    public function getRoutableEntities(Route $route) : Collection
    {
        return $route->routables->sortBy('order')
            ->map(function (Routable $routable) {
                return $routable->routable;
            })->filter();
    }

    /**
     * @param Route $route
     *
     * @return mixed
     */
    public function getRelatedRoutableIds(Route $route)
    {
        return $route->routables->map(function (Routable $routable) {
            $model = strtolower(collect(explode("\\", $routable->routable_type))->last());

            return $model . '_' . $routable->routable_id;
        });
    }

    /**
     * @param Route      $route
     * @param array|null $routableIds
     */
    public function saveRoutableList(Route $route, ? array $routableIds) : void
    {
        if (! $routableIds) {
            return;
        }

        $order = 0;
        foreach ($routableIds as $routable) {
            [$model, $id] = explode("_", $routable);
            $route->routables()->create([
                'order' => $order,
                'routable_id' => $id,
                'routable_type' => 'App\\Models\\' . ucfirst($model)
            ]);
            $order++;
        }
    }

    /**
     * @param Route      $route
     * @param array|null $routableIds
     */
    public function deleteRoutableList(Route $route, ? array $routableIds)
    {
        collect($routableIds)
            ->each(function ($item) use ($route) {
                [$model, $id] = explode("_", $item);
                $route->routables()
                    ->where('routable_id', $id)
                    ->where('routable_type', 'App\\Models\\' . ucfirst($model))
                    ->delete();
            });
    }
}
