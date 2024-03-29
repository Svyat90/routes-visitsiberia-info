<?php

namespace App\Services\Csv;

use PhpOffice\PhpSpreadsheet\Writer\Exception as SpreadException;
use App\Repositories\PlaceRepository;
use App\Models\Place;
use App\Repositories\HotelRepository;
use App\Models\Hotel;
use App\Repositories\MealRepository;
use App\Models\Meal;

class ExportService extends CsvService
{

    /**
     * @param string $type
     *
     * @return string
     * @throws SpreadException
     */
    public function generateFile(string $type) : string
    {
        $this->initWorkSheet($type);

        $this->fillWorkSheet($type);

        return $this->saveFile();
    }

    /**
     * @param string $type
     */
    private function fillWorkSheet(string $type) : void
    {
        switch ($type) {
            case self::TYPE_PLACES:
                $this->fillPlaces();
                break;
            case self::TYPE_HOTELS:
                $this->fillHotels();
                break;
            case self::TYPE_MEALS:
                $this->fillMeals();
                break;
        }
    }

    private function fillPlaces() : void
    {
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
                ->setCellValue($this->cols['image_author'] . $this->row, $title)
                ->setCellValue($this->cols['image_desc'] . $this->row, $desc)
                ->setCellValue($this->cols['image_author_link'] . $this->row, $authorLink)
                ->setCellValue($this->cols['image_gallery'] . $this->row, $this->implodeStrings($galleryData, 'urls'))
                ->setCellValue($this->cols['image_gallery_title'] . $this->row, $this->implodeStrings($galleryData, 'title'))
                ->setCellValue($this->cols['image_gallery_desc'] . $this->row, $this->implodeStrings($galleryData, 'desc'))
                ->setCellValue($this->cols['image_gallery_author_link'] . $this->row, $this->implodeStrings($galleryData, 'author_links'))
                ->setCellValue($this->cols['page_desc'] . $this->row, $place->page_desc)
                ->setCellValue($this->cols['history_desc'] . $this->row, $place->history_desc)
                ->setCellValue($this->cols['contact_desc'] . $this->row, $place->contact_desc)
                ->setCellValue($this->cols['life_hacks'] . $this->row, $place->life_hacks)
                ->setCellValue($this->cols['lat'] . $this->row, $place->lat)
                ->setCellValue($this->cols['lng'] . $this->row, $place->lng)
                ->setCellValue($this->cols['location'] . $this->row, $place->location)
                ->setCellValue($this->cols['site_link'] . $this->row, $place->site_link)
                ->setCellValue($this->cols['social_links'] . $this->row, $place->social_links)
                ->setCellValue($this->cols['contacts_representatives'] . $this->row, $place->contacts_representatives)
                ->setCellValue($this->cols['additional_links'] . $this->row, $place->additional_links)
                ->setCellValue($this->cols['contacts_delivery'] . $this->row, $place->contacts_delivery);
        }
    }

    private function fillHotels() : void
    {
        $hotels = (new HotelRepository())->getCollectionToExport();

        /** @var Hotel $hotel */
        foreach ($hotels as $hotel) {
            ++$this->row;

            [$link, $title, $desc, $authorLink] = $this->generateImageData($hotel);
            $galleryData = $this->generateImageData($hotel, 'image_gallery');
            $properties = $this->generateDictionariesData($hotel);

            $this->sheet
                ->setCellValue($this->cols['id'] . $this->row, $hotel->id)
                ->setCellValue($this->cols['name'] . $this->row, $hotel->name)
                ->setCellValue($this->cols['properties'] . $this->row, implode(";", $properties))
                ->setCellValue($this->cols['image'] . $this->row, $link)
                ->setCellValue($this->cols['image_author'] . $this->row, $title)
                ->setCellValue($this->cols['image_desc'] . $this->row, $desc)
                ->setCellValue($this->cols['image_author_link'] . $this->row, $authorLink)
                ->setCellValue($this->cols['image_gallery'] . $this->row, $this->implodeStrings($galleryData, 'urls'))
                ->setCellValue($this->cols['image_gallery_title'] . $this->row, $this->implodeStrings($galleryData, 'title'))
                ->setCellValue($this->cols['image_gallery_desc'] . $this->row, $this->implodeStrings($galleryData, 'desc'))
                ->setCellValue($this->cols['image_gallery_author_link'] . $this->row, $this->implodeStrings($galleryData, 'author_links'))
                ->setCellValue($this->cols['conditions_accommodation'] . $this->row, $hotel->conditions_accommodation)
                ->setCellValue($this->cols['conditions_payment'] . $this->row, $hotel->conditions_payment)
                ->setCellValue($this->cols['contact_desc'] . $this->row, $hotel->contact_desc)
                ->setCellValue($this->cols['room_desc'] . $this->row, $hotel->room_desc)
                ->setCellValue($this->cols['additional_services'] . $this->row, $hotel->additional_services)
                ->setCellValue($this->cols['food_desc'] . $this->row, $hotel->food_desc)
                ->setCellValue($this->cols['site_link'] . $this->row, $hotel->site_link)
                ->setCellValue($this->cols['social_links'] . $this->row, $hotel->social_links)
                ->setCellValue($this->cols['aggregator_links'] . $this->row, $hotel->aggregator_links)
                ->setCellValue($this->cols['phones'] . $this->row, $hotel->phones)
                ->setCellValue($this->cols['lat'] . $this->row, $hotel->lat)
                ->setCellValue($this->cols['lng'] . $this->row, $hotel->lng)
                ->setCellValue($this->cols['location'] . $this->row, $hotel->location);
        }
    }

    private function fillMeals() : void
    {
        $meals = (new MealRepository())->getCollectionToExport();

        /** @var Meal $meal */
        foreach ($meals as $meal) {
            ++$this->row;

            [$link, $title, $desc, $authorLink] = $this->generateImageData($meal);
            $galleryData = $this->generateImageData($meal, 'image_gallery');
            $properties = $this->generateDictionariesData($meal);

            $this->sheet
                ->setCellValue($this->cols['id'] . $this->row, $meal->id)
                ->setCellValue($this->cols['name'] . $this->row, $meal->name)
                ->setCellValue($this->cols['properties'] . $this->row, implode(";", $properties))
                ->setCellValue($this->cols['image'] . $this->row, $link)
                ->setCellValue($this->cols['image_author'] . $this->row, $title)
                ->setCellValue($this->cols['image_desc'] . $this->row, $desc)
                ->setCellValue($this->cols['image_author_link'] . $this->row, $authorLink)
                ->setCellValue($this->cols['image_gallery'] . $this->row, $this->implodeStrings($galleryData, 'urls'))
                ->setCellValue($this->cols['image_gallery_title'] . $this->row, $this->implodeStrings($galleryData, 'title'))
                ->setCellValue($this->cols['image_gallery_desc'] . $this->row, $this->implodeStrings($galleryData, 'desc'))
                ->setCellValue($this->cols['image_gallery_author_link'] . $this->row, $this->implodeStrings($galleryData, 'author_links'))
                ->setCellValue($this->cols['page_desc'] . $this->row, $meal->page_desc)
                ->setCellValue($this->cols['working_hours'] . $this->row, $meal->working_hours)
                ->setCellValue($this->cols['site_link'] . $this->row, $meal->site_link)
                ->setCellValue($this->cols['social_links'] . $this->row, $meal->social_links)
                ->setCellValue($this->cols['phones'] . $this->row, $meal->phones)
                ->setCellValue($this->cols['lat'] . $this->row, $meal->lat)
                ->setCellValue($this->cols['lng'] . $this->row, $meal->lng)
                ->setCellValue($this->cols['location'] . $this->row, $meal->location)
                ->setCellValue($this->cols['recommended'] . $this->row, $meal->recommended)
                ->setCellValue($this->cols['have_breakfasts'] . $this->row, $meal->have_breakfasts)
                ->setCellValue($this->cols['have_business_lunch'] . $this->row, $meal->have_business_lunch)
                ->setCellValue($this->cols['delivery_available'] . $this->row, $meal->delivery_available);
        }
    }

}
