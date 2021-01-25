<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\Replies\StoreReplyRequest;
use App\Models\Reply;
use App\Models\Review;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Services\ReviewService;

class ReplyController extends AdminController
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
     * @param Review $review
     * @return View
     */
    public function create(Review $review) : View
    {
        return view('admin.replies.create', compact('review'));
    }

    /**
     * @param StoreReplyRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreReplyRequest $request) : RedirectResponse
    {
        /** @var Review $review */
        $review = Review::query()->findOrFail($request->review_id);
        $this->service->repository->saveReply($review, $request->validated());

        return redirect()->route('admin.reviews.show', $review->id);
    }

    /**
     * @param Reply $reply
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Reply $reply) : RedirectResponse
    {
        $reply->delete();

        return back();
    }

}
