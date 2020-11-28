<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{
    /**
     * @var string[]
     */
    private array $languages = [
        'ru', 'en'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect($this->languages)->each(function (string $locale) {
            $this->command->info('Added language: ' . $locale);

            Language::query()->create([
                'locale' => $locale,
                'active' => true
            ]);
        });
    }

}
