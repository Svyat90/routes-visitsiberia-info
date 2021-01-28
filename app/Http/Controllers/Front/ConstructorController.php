<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontController;
use App\Repositories\VarRepository;
use App\Services\Browser\ConstructorService;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ConstructorController extends FrontController
{

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function choose(Request $request)
    {
        return view('front.pages.choose');
    }

    /**
     * @param Request $request
     * @param ConstructorService $constructorService
     * @return Application|Factory|View
     */
    public function constructor(Request $request, ConstructorService $constructorService)
    {
        $entities = $constructorService->getRouteData();

        return view('front.pages.constructor', compact('entities'));
    }

    /**
     * @param Request $request
     * @param VarRepository $varRepository
     * @return mixed
     */
    public function saveRoute(Request $request, VarRepository $varRepository)
    {
        if (! $request->route_data) {
            return redirect()->back();
        }

        $inputData = json_decode($request->route_data);

        $routeData = [];
        foreach ($inputData as $key => $data) {
            $id = $data[0];
            $name = $data[1];
            $namespace = $data[2] . 's';
            $imgLink = $data[3];

            $routeItem = new \stdClass;
            $routeItem->page_link = route('front.' . $namespace . '.show', $id);
            $routeItem->name = iconv('UTF-8', 'utf-8//TRANSLIT', $name);
            $routeItem->number = $key + 1;
            $routeItem->image = base64_encode(file_get_contents($imgLink));
            $routeData[] = $routeItem;
        }

        $html = view('front.pdf.route', [
            'routeData' => $routeData,
            'name' => $request->route_name ?? $varRepository->getAllVars()['routes_my_route']
        ]);

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($html);

        return $pdf->download('route.pdf');
    }
}
