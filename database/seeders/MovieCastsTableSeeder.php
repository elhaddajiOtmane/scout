<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MovieCastsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $batchSize = 1000; // Adjust batch size as needed
        $casts = [];

        for ($i = 1; $i <= 300000; $i++) {
            $casts[] = [
                'id' => $faker->uuid,
                'movie_id' => $faker->numberBetween(1, 10000),
                'name' => $faker->name,
                'original_name' => $faker->name,
                'popularity' => $faker->randomFloat(2, 0, 10),
                'profile_path' => $faker->imageUrl(),
                'character' => $faker->word,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($casts) == $batchSize) {
                DB::table('movie_casts')->insert($casts);
                $casts = [];
            }
        }

        // Insert remaining records
        if (!empty($casts)) {
            DB::table('movie_casts')->insert($casts);
        }
    }
}
