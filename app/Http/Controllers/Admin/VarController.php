<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\VarModel;
use App\Services\VarService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\Vars\UpdateVarRequest;

class VarController extends AdminController
{
    /**
     * @var VarService
     */
    private VarService $service;

    /**
     * VarModelController constructor.
     *
     * @param VarService $service
     */
    public function __construct(VarService $service)
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

        return view('admin.vars.index');
    }

    /**
     * @param VarModel $var
     *
     * @return Application|Factory|View
     */
    public function show(VarModel $var)
    {
        return view('admin.vars.show', compact('var'));
    }

    /**
     * @param VarModel $var
     *
     * @return Application|Factory|View
     */
    public function edit(VarModel $var)
    {
        return view('admin.vars.edit', compact('var'));
    }

    /**
     * @param UpdateVarRequest $request
     * @param VarModel              $var
     *
     * @return RedirectResponse
     */
    public function update(UpdateVarRequest $request, VarModel $var)
    {
        $var = $this->service->updateVar($request, $var);

        return redirect()->route('admin.vars.show', $var->id);
    }

    /**
     * @param VarModel $var
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(VarModel $var) : RedirectResponse
    {
        $var->delete();

        return back();
    }

}
