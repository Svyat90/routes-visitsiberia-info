<?php

namespace App\Services\Csv;

use PhpOffice\PhpSpreadsheet\Writer\Exception as SpreadException;
use App\Repositories\PlaceRepository;
use App\Models\Place;

class ExportService extends CsvService
{

    /**
     * ExportService constructor.
     */
    public function __construct()
    {
        parent::__construct('Places');
    }

    /**
     * @return string
     * @throws SpreadException
     */
    public function generateFile() : string
    {
        $this->initWorkSheet();

        $places = (new PlaceRepository())->getCollectionToExport();

        /** @var Place $place */
        foreach ($places as $place) {
            ++$this->row;

            [$link, $title, $desc, $authorLink] = $this->generateImageData($place);
            $galleryData = $this->generateImageData($place, 'image_gallery');
            $properties = $this->generateDictionariesData($place);

            $this->sheet
                ->setCellValue($this->cols['id'] . $this->row, $place->id)
                ->setCellValue($this->cols['name'] . $this->row, $place->name)
                ->setCellValue($this->cols['properties'] . $this->row, implode(";", $properties))
                ->setCellValue($this->cols['image'] . $this->row, $link)
                ->setCellValue($this->cols['image_title'] . $this->row, $title)
                ->setCellValue($this->cols['image_desc'] . $this->row, $desc)
                ->setCellValue($this->cols['image_author_link'] . $this->row, $authorLink)
                ->setCellValue($this->cols['image_gallery'] . $this->row, implode(";", $galleryData['urls']))
                ->setCellValue($this->cols['image_gallery_title'] . $this->row, implode(";", $galleryData['title']))
                ->setCellValue($this->cols['image_gallery_desc'] . $this->row, implode(";", $galleryData['desc']))
                ->setCellValue($this->cols['image_gallery_author_link'] . $this->row, implode(";", $galleryData['author_links']))
                ->setCellValue($this->cols['page_desc'] . $this->row, $place->page_desc)
                ->setCellValue($this->cols['history_desc'] . $this->row, $place->history_desc)
                ->setCellValue($this->cols['contact_desc'] . $this->row, $place->contact_desc)
                ->setCellValue($this->cols['life_hacks'] . $this->row, $place->life_hacks)
                ->setCellValue($this->cols['helpful_info'] . $this->row, $place->helpful_info)
                ->setCellValue($this->cols['lat'] . $this->row, $place->lat)
                ->setCellValue($this->cols['lng'] . $this->row, $place->lng)
                ->setCellValue($this->cols['location'] . $this->row, $place->location);
        }

        return $this->saveFile();
    }
}
