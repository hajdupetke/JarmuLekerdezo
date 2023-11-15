<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SearchHistory>
 */
class SearchHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'searched_license' => strtoupper(fake()->lexify('???')) . '-' . fake()->numerify('###'),
            'search_time' => fake()->dateTime()->format('Y-m-d H:i:s'),
        ];
    }
}
