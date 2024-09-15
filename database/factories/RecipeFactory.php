<?php

namespace Database\Factories;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    protected $model = Recipe::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'ingredients' => $this->faker->paragraphs(3, true),
            'instructions' => $this->faker->paragraphs(5, true),
            'prep_time' => $this->faker->numberBetween(5, 60),
            'cook_time' => $this->faker->numberBetween(10, 120),
            'servings' => $this->faker->numberBetween(1, 8),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
