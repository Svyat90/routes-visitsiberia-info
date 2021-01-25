<?php

namespace App\Services;

use App\Helpers\DatatablesHelper;
use App\Helpers\LabelHelper;
use App\Http\Requests\Admin\Reviews\UpdateReviewRequest;
use App\Http\Requests\Front\Reviews\ReviewStoreRequest;
use App\Models\Event;
use App\Models\Hotel;
use App\Models\Meal;
use App\Models\Place;
use App\Models\Review;
use App\Models\Route;
use App\Repositories\ReviewRepository;
use Yajra\DataTables\Facades\DataTables;

class ReviewService
{

    /**
     * @var ReviewRepository
     */
    public ReviewRepository $repository;

    /**
     * DictionaryService constructor.
     *
     * @param ReviewRepository $repository
     */
    public function __construct(ReviewRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param ReviewStoreRequest $request
     * @return mixed
     */
    public function detectEntityModel(ReviewStoreRequest $request)
    {
        switch ($request->entity) {
            case 'routes':
                return Route::query()->find($request->entityId);
            case 'places':
                return Place::query()->find($request->entityId);
            case 'events':
                return Event::query()->find($request->entityId);
            case 'hotels':
                return Hotel::query()->find($request->entityId);
            case 'meals':
                return Meal::query()->find($request->entityId);
            default:
                return null;
        }
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getDatatablesData()
    {
        $collection = $this->repository->getCollectionToIndex();

        return Datatables::of($collection)
            ->addColumn('placeholder', '&nbsp;')
            ->editColumn('id', fn ($row) => $row->id)
            ->editColumn('name', fn ($row) => $row->name)
            ->editColumn('phone', fn ($row) => $row->phone)
            ->editColumn('email', fn ($row) => $row->email)
            ->editColumn('rating', fn ($row) => $row->rating . '/5')
            ->editColumn('approved', fn ($row) => LabelHelper::boolLabel($row->approved))
            ->editColumn('allow_comments', fn ($row) => LabelHelper::boolLabel($row->allow_comments))
            ->editColumn('object', fn ($row) => $row->reviewrateable_type)
            ->editColumn('object_id', fn ($row) => $row->reviewrateable_id)
            ->addColumn('actions', fn ($row) => DatatablesHelper::renderActionsRow($row, 'reviews'))
            ->rawColumns(['placeholder', 'actions', 'approved', 'allow_comments'])
            ->make(true);
    }

    /**
     * @param UpdateReviewRequest $request
     * @param Review              $review
     *
     * @return Review
     */
    public function updateReview(UpdateReviewRequest $request, Review $review) : Review
    {
        return $this->repository->updateData($request->all(), $review);
    }

}
