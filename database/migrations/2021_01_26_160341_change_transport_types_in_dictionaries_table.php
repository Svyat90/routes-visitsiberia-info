<?php

use Illuminate\Database\Migrations\Migration;
use \App\Services\DictionaryService;
use \App\Models\Dictionary;

class ChangeTransportTypesInDictionariesTable extends Migration
{
    public function up()
    {
        $service = app(DictionaryService::class);
        $transportList = $service->getTransportList();

        foreach ($transportList as $key => $transport) {
            switch (true) {
                case $key === 0:
                    $transport->update(['type' => 'auto']);
                    break;
                case $key === 1:
                    $transport->update(['type' => 'masstransit']);
                    break;
                case $key === 2:
                    $transport->update(['type' => 'pedestrian']);
                    break;
            }
        }

        $tag = Dictionary::query()
            ->where('type', '=', 'tag')
            ->first();

        Dictionary::query()
            ->where('parent_id', $tag->id)
            ->forceDelete();

        $tag->forceDelete();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
