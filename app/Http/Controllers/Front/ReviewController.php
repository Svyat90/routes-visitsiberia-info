<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontController;
use App\Http\Requests\Front\Reviews\ReviewStoreRequest;
use App\Models\Review;
use App\Services\ReviewService;
use \Illuminate\Http\RedirectResponse;

/**
 * Class ReviewController
 */
class ReviewController extends FrontController
{
    /**
     * @var ReviewService
     */
    private ReviewService $reviewService;

    /**
     * ReviewController constructor.
     * @param ReviewService $reviewService
     */
    public function __construct(ReviewService $reviewService)
    {
        parent::__construct();

        $this->reviewService = $reviewService;
    }

    /**
     * @param ReviewStoreRequest $request
     * @return RedirectResponse|Review
     */
    public function store(ReviewStoreRequest $request)
    {
        $entity = $this->reviewService->detectEntityModel($request);
        if (! $entity) {
            \session()->flash('error-review', true);
            return redirect()->back();
        }

        $review = $entity->rating($request->validated());

        if ($review) {
            \session()->flash('success-create-review', true);
        }

        return redirect()->back();
    }

}
