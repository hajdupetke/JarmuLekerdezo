<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //generate 10 users with search histories

        \App\Models\User::factory(10)->create()->each(function ($user) {
            //Seed the relation with 5 search history

            $history = \App\Models\SearchHistory::factory(5)->make();
            $user->searchHistory()->saveMany($history);
        }); 

        // generate vehicles
        \App\Models\Vehicle::factory(10)->create();

        // generate incidents
        \App\Models\Incident::factory(20)->create();

        // populate pivot table
        $incidents = \App\Models\Incident::all();

        \App\Models\Vehicle::all()->each(function ($vehicle) use ($incidents) {
            $vehicle->incidents()->attach(
                $incidents->random(rand(1, 5))->pluck('id')->toArray()
            );
        });
    }
}