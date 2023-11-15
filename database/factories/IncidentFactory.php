<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Incident>
 */
class IncidentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $locations = array('Budapest', 'Pomáz', 'Pécs', 'Győr', 'Kecskemét', 'Bugyi', 'Dabas', 'Eger', 'Szentendre', 'Kalocsa');
    
        return [
            'location' => array_rand($locations),
            'time' => fake()->dateTime()->format('Y-m-d H:i:s'),
            'desc' => fake()->realText()
        ];
    }
}
