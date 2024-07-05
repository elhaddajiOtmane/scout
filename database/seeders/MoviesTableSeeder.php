<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $batchSize = 1000; // Adjust batch size as needed
        $movies = [];

        for ($i = 1; $i <= 10000; $i++) {
            $movies[] = [
                'id' => $faker->uuid,
                'movie_id' => $i,
                'original_title' => $faker->sentence(3),
                'original_language' => $faker->languageCode,
                'overview' => $faker->paragraph,
                'popularity' => $faker->randomFloat(2, 0, 10),
                'poster_path' => $faker->imageUrl(),
                'backdrop_path' => $faker->imageUrl(),
                'release_date' => $faker->date(),
                'vote_average' => $faker->randomFloat(2, 0, 10),
                'vote_count' => $faker->numberBetween(1, 10000),
                'adult' => $faker->boolean,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($movies) == $batchSize) {
                DB::table('movies')->insert($movies);
                $movies = [];
            }
        }

        // Insert remaining records
        if (!empty($movies)) {
            DB::table('movies')->insert($movies);
        }
    }
}
