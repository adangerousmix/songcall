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

        \App\Models\Song::factory()->create([
            'request' => 'Represent by Weezer',
            'requester' => 'ADangerousMix',
            'extra_life' => true,
            'donation' => '30'
        ]);

        \App\Models\Song::factory()->create([
            'request' => 'Got the Life by Korn',
            'requester' => 'ADangerousMix',
            'extra_life' => false,
            'donation' => ''
        ]);

        \App\Models\Song::factory()->create([
            'request' => 'Island in the Sun by Weezer',
            'requester' => 'GearboxUnion',
            'extra_life' => true,
            'donation' => '25'
        ]);

        \App\Models\Song::factory()->create([
            'request' => 'Right Stuff by New Kids on the Block',
            'requester' => 'Tweedle9200',
            'extra_life' => false,
            'donation' => ''
        ]);
    }
}
