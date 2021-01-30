<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Subscribe\SubscribeRequest;
use App\Models\Subscriber;
use \Illuminate\Http\RedirectResponse;

/**
 * @group Subscribe
 */
class SubscribeController extends Controller
{

    /**
     * @param SubscribeRequest $request
     * @return RedirectResponse
     */
    public function subscribe(SubscribeRequest $request) : RedirectResponse
    {
        $created = Subscriber::query()->create($request->validated());

        if ($created) {
            session()->flash('subscribed', true);
        }

        return redirect()->back();
    }

}
