<?php

namespace Database\Factories;

use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Helpers\SlugHelper;

class PlaceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Place::class;

    /**
     * @var array|\string[][]
     */
    private array $coordinates = [
        ['49.839', '23.995'],
        ['49.839', '23.996'],
        ['49.84458025', '24.02234908'],
        ['49.839', '23.995'],
        ['49.82471438', '24.02934008'],
        ['49.839', '23.996'],
        ['49.839', '23.995'],
        ['49.81126022', '23.9980526'],
        ['49.83524', '24.03517'],
        ['49.839', '23.995'],
        ['49.83524', '24.03517'],
        ['49.839', '23.995'],
        ['49.83261679', '24.06766883'],
        ['49.83524', '24.03517'],
        ['49.848', '24.068'],
        ['49.839', '23.995'],
        ['49.839', '23.995'],
        ['49.839', '23.995'],
        ['49.839', '23.995'],
        ['49.792', '24.064'],
        ['49.80508793', '24.01652534'],
        ['49.848', '24.068'],
        ['49.839', '23.995'],
        ['49.839', '23.995'],
        ['49.83524', '24.03517'],
        ['49.83524', '24.03517'],
        ['49.839', '23.995'],
        ['49.839', '23.996'],
        ['49.839', '23.995'],
        ['49.839', '23.995'],
        ['49.839', '23.995'],
        ['49.83524', '24.03517'],
        ['49.83524', '24.03517'],
        ['49.83689645', '23.97694559'],
        ['49.839', '23.996'],
        ['49.83524', '24.03517'],
        ['49.86744433', '24.00216686'],
        ['49.839', '23.996'],
        ['49.83745159', '24.00774848'],
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $coordinates = collect($this->coordinates)->random();

        return [
            'name' => [
                'ru' => $name = $this->faker->name,
                'en' => $this->faker->name,
            ],
            'lat' => $coordinates[0],
            'lng' => $coordinates[1],
            'slug' => SlugHelper::generate(new Place(), ['ru' => $name])
        ];
    }
}
