<?php

namespace App\Services\Csv;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\Traits\FilterConstantsTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\Dictionary;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Shared\File;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

abstract class CsvService
{
    use FilterConstantsTrait;

    public const TYPE_PLACES = 'places';
    public const TYPE_HOTELS = 'hotels';
    public const TYPE_MEALS = 'meals';
    public const TYPE_EVENTS = 'events';

    /**
     * @var Spreadsheet
     */
    protected Spreadsheet $spreadsheet;

    /**
     * @var Worksheet
     */
    protected Worksheet $sheet;

    /**
     * @var string
     */
    protected string $sheetName;

    /**
     * @var int
     */
    protected int $row = 1;

    /**
     * @var string[]
     */
    protected array $cols;

    /**
     * @var array
     */
    private array $config;

    /**
     * CsvController constructor.
     */
    public function __construct()
    {
        $this->spreadsheet = new Spreadsheet();
        $this->config = include (config_path('export.php'));
    }

    /**
     * @return array
     */
    public function getExportTypes()
    {
        return self::filterConstants('TYPE');
    }

    /**
     * @param string $sheetName
     */
    protected function initWorkSheet(string $sheetName) : void
    {
        $this->sheetName = $sheetName;
        $this->cols = $this->config['cols'][$sheetName];

        $this->sheet = $this->spreadsheet
            ->getActiveSheet()
            ->setTitle($this->sheetName);

        foreach ($this->cols as $name => $index) {
            $this->sheet->setCellValue($index . $this->row, $name);
        }
    }

    /**
     * @param Model  $model
     * @param string $collectionName
     *
     * @return array
     */
    protected function generateImageData(Model $model, string $collectionName = 'image')
    {
        /** @var Media $media */
        if ($collectionName === 'image') {
            $media = $model->getMedia($collectionName)->last();

            return $this->normalizeData($media);
        }

        $collectData = [];
        $model->getMedia($collectionName)->each(function (Media $media) use (&$collectData) {
            $itemData = $this->normalizeData($media);
            $collectData['urls'][] = $itemData[0];
            $collectData['title'][] = $itemData[1];
            $collectData['desc'][] = $itemData[2];
            $collectData['author_links'][] = $itemData[3];
        });

        return $collectData;
    }

    /**
     * @param Media $media
     *
     * @return array
     */
    protected function normalizeData(Media $media)
    {
        return [
            $media->getFullUrl(),
            $media->getCustomProperty('title', ''),
            $media->getCustomProperty('desc', ''),
            $media->getCustomProperty('author_link', ''),
        ];
    }

    /**
     * @param Model $model
     *
     * @return mixed
     */
    protected function generateDictionariesData(Model $model)
    {
        return $model->dictionaries->filter(function (Dictionary $dictionary) {
            return $dictionary->parent;
        })->map(function (Dictionary $dictionary) {
            return $dictionary->parent->name . ":" . $dictionary->name;
        })->toArray();
    }

    /**
     * @return string
     * @throws Exception
     */
    protected function saveFile() : string
    {
        $writer = new Xlsx($this->spreadsheet);
        $filePath = storage_path('export/export_' . strtolower($this->sheetName) . '_' . date("Y-m-d-H-i-s") . '.xlsx');
        File::setUseUploadTempDirectory(true);
        $writer->save($filePath);

        return $filePath;
    }

    /**
     * @param array  $data
     * @param string $key
     *
     * @return string
     */
    protected function implodeStrings(array $data, string $key) : string
    {
        if (isset($data[$key])) {
            return implode(";", $data[$key]);
        }

        return '';
    }
}
