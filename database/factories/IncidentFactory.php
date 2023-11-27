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
            'location' => $locations[rand(0, count($locations) -1)],
            'time' => fake()->dateTimeBetween('-5 years', 'now')->format('Y-m-d H:i:s'),
            'desc' => fake()->realText()
        ];
    }
}
