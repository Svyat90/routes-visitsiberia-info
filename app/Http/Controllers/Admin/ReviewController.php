<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\Review;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\Reviews\UpdateReviewRequest;
use App\Http\Requests\Admin\Reviews\MassDestroyReviewRequest;
use App\Services\ReviewService;

class ReviewController extends AdminController
{
    /**
     * @var ReviewService
     */
    private ReviewService $service;

    /**
     * ReviewController constructor.
     *
     * @param ReviewService    $service
     */
    public function __construct(ReviewService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * @param Request $request
     *
     * @return Application|Factory|View|mixed
     * @throws \Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->service->getDatatablesData();
        }

        return view('admin.reviews.index');
    }

    /**
     * @param Review $review
     *
     * @return Application|Factory|View
     */
    public function show(Review $review)
    {
        $review->load('replies');

        return view('admin.reviews.show', compact('review'));
    }

    /**
     * @param Review                $review
     *
     * @return Application|Factory|View
     */
    public function edit(Review $review)
    {
        return view('admin.reviews.edit', compact('review'));
    }

    /**
     * @param UpdateReviewRequest $request
     * @param Review              $review
     *
     * @return RedirectResponse
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        $review = $this->service->updateReview($request, $review);

        return redirect()->route('admin.reviews.show', $review->id);
    }

    /**
     * @param Review $review
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Review $review) : RedirectResponse
    {
        $review->delete();

        return back();
    }

    /**
     * @param MassDestroyReviewRequest $request
     *
     * @return Response
     * @throws \Exception
     */
    public function massDestroy(MassDestroyReviewRequest $request) : Response
    {
        $this->service->repository->deleteIds($request->ids);

        return response()->noContent();
    }

}
