<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SourceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'key' => $this->faker->unique()->word(),
            'name' => ucfirst($this->faker->word()),
            'base_url' => $this->faker->url(),
        ];
    }
}
