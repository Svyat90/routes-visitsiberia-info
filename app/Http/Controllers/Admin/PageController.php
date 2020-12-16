<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\Page;
use App\Services\PageService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\Pages\UpdatePageRequest;

class PageController extends AdminController
{

    /**
     * @var PageService
     */
    private PageService $service;

    /**
     * PageController constructor.
     *
     * @param PageService    $service
     */
    public function __construct(PageService $service)
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

        return view('admin.pages.index');
    }

    /**
     * @param Page $page
     *
     * @return Application|Factory|View
     */
    public function show(Page $page)
    {
        return view('admin.pages.show', compact('page'));
    }

    /**
     * @param Page          $page
     *
     * @return Application|Factory|View
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * @param UpdatePageRequest $request
     * @param Page              $page
     *
     * @return RedirectResponse
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        $page->update($request->validated());

        return redirect()->route('admin.pages.show', $page->id);
    }
}
