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

         // generate vehicles
         \App\Models\Vehicle::factory(10)->create();

        //generate 15 users with search histories

        \App\Models\User::factory(15)->create()->each(function ($user) {
            //Seed the relation with 5 search history

            $history = \App\Models\SearchHistory::factory(3)->make();       
            $user->searchHistory()->saveMany($history);
        }); 

        // make 5 random users to be premium users

        \App\Models\User::all()->random(5)->each(function ($user) {
            $user->is_premium = 1;
            $user->save();
        });

        // make 1 random user to be admin
        // make admin email admin@admin.com

        \App\Models\User::all()->random(1)->each(function ($user) {
            $user->email = 'admin@admin.com';
            $user->is_admin = 1;
            $user->is_premium = 1;
            $user->save();
        });
       

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