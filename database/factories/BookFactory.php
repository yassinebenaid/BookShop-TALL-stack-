<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $index = $this->faker->numberBetween(0, 5);

        return [
            "name" => $this->faker->sentence(3),
            "description" => $this->faker->paragraphs(5, true),
            "price" => $this->faker->randomFloat(3, 10, 999),
            "discount" => $this->faker->numberBetween(6, 50),
            "author" => $this->faker->name(),
            "release_year" => $this->faker->year(),
            "images" => json_encode([]),
            "pages_count" => $this->faker->numberBetween(50, 500),
            "age_class" => [8, 10, 12, 13, 17, 21][$index],
            "category_id" => $this->faker->numberBetween(1, 40)
        ];
    }
}
