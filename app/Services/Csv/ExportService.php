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
        parent::__construct('Places', [
            'id' => 'A',
            'name' => 'B',
            'properties' => 'C',
            'image' => 'D',
            'image_title' => 'E',
            'image_desc' => 'F',
            'image_author_link' => 'G',
            'image_gallery' => 'H',
            'image_gallery_title' => 'I',
            'image_gallery_desc' => 'J',
            'image_gallery_author_link' => 'K',
            'page_desc' => 'L',
            'history_desc' => 'M',
            'contact_desc' => 'N',
            'life_hacks' => 'O',
            'helpful_info' => 'P',
            'lat' => 'Q',
            'lng' => 'R',
            'location' => 'S',
        ]);
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
                ->setCellValue($this->csvCols['id'] . $this->row, $place->id)
                ->setCellValue($this->csvCols['name'] . $this->row, $place->name)
                ->setCellValue($this->csvCols['properties'] . $this->row, implode(";", $properties))
                ->setCellValue($this->csvCols['image'] . $this->row, $link)
                ->setCellValue($this->csvCols['image_title'] . $this->row, $title)
                ->setCellValue($this->csvCols['image_desc'] . $this->row, $desc)
                ->setCellValue($this->csvCols['image_author_link'] . $this->row, $authorLink)
                ->setCellValue($this->csvCols['image_gallery'] . $this->row, implode(";", $galleryData['urls']))
                ->setCellValue($this->csvCols['image_gallery_title'] . $this->row, implode(";", $galleryData['title']))
                ->setCellValue($this->csvCols['image_gallery_desc'] . $this->row, implode(";", $galleryData['desc']))
                ->setCellValue($this->csvCols['image_gallery_author_link'] . $this->row, implode(";", $galleryData['author_links']))
                ->setCellValue($this->csvCols['page_desc'] . $this->row, $place->page_desc)
                ->setCellValue($this->csvCols['history_desc'] . $this->row, $place->history_desc)
                ->setCellValue($this->csvCols['contact_desc'] . $this->row, $place->contact_desc)
                ->setCellValue($this->csvCols['life_hacks'] . $this->row, '')
                ->setCellValue($this->csvCols['helpful_info'] . $this->row, $place->helpful_info)
                ->setCellValue($this->csvCols['lat'] . $this->row, $place->lat)
                ->setCellValue($this->csvCols['lng'] . $this->row, $place->lng)
                ->setCellValue($this->csvCols['location'] . $this->row, $place->location);
        }

        return $this->saveFile();
    }
}
