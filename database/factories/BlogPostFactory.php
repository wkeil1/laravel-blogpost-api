<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogPost>
 */
class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      return [
        'author_id' => null,  // This will be provided during seeding
        'title' => $this->faker->sentence,
        'content' => $this->faker->paragraphs(2, true),
        'is_published' => $this->faker->boolean,
        'status' => $this->faker->randomElement(['Approved', 'Pending', 'Rejected']),
      ];
    }
}
