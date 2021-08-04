<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'title' => $this->faker->sentence(random_int(2, 6)),
            'director' => function () {
                return User::query()->inRandomOrder()->value('id');
            },
            'describe' => $this->faker->text,
            'rate' => mt_rand(0, 10),
            'released' => mt_rand(0, 1),
            'release_at' => function (array $attr) {
                return $attr['released'] == 1 ? now()->toDateTimeString() : '0000-00-00';
            },
        ];
    }
}
