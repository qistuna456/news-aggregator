<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Source;

class ArticleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'source_id' => Source::factory(),
            'external_id' => $this->faker->uuid(),
            'title' => $this->faker->sentence(),
            'summary' => $this->faker->paragraph(),
            'content' => $this->faker->text(600),
            'author' => $this->faker->name(),
            'url' => $this->faker->unique()->url(),
            'url_to_image' => $this->faker->imageUrl(),
            'category' => $this->faker->word(),
            'published_at' => $this->faker->dateTimeThisYear(),
            'raw' => [],
        ];
    }
}
