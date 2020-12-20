<?php

namespace App\Http\Controllers\Admin\Csv;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Services\Csv\ExportService;
use \Symfony\Component\HttpFoundation\BinaryFileResponse;
use \PhpOffice\PhpSpreadsheet\Writer\Exception;
use \Illuminate\Contracts\Foundation\Application;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\View\View;

class ExportController extends AdminController
{

    /**
     * @var ExportService
     */
    private ExportService $exportService;

    /**
     * ExportController constructor.
     *
     * @param ExportService $exportService
     */
    public function __construct(ExportService $exportService)
    {
        parent::__construct();
        $this->exportService = $exportService;
    }

    /**
     * @param Request $request
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $types = $this->exportService->getExportTypes();

        return view('admin.export.index', compact('types'));
    }

    /**
     * @param Request       $request
     *
     * @return BinaryFileResponse
     * @throws Exception
     */
    public function export(Request $request)
    {
        $filePath = $this->exportService->generateFile();

        return response()->download($filePath);
    }

}
