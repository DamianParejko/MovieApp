<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'category' => $this->faker->sentence,
            'director' => $this->faker->name,
            'description' => $this->faker->paragraph,
            'time' => $this->faker->numberBetween(60, 180),
            'year' => $this->faker->numberBetween(1800, 2021)
        ];
    }
}
