<?php

namespace Database\Seeders;

use App\Models\AdministrativeRegion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $administrativeRegions = AdministrativeRegion::all();

        foreach ($administrativeRegions as $administrativeRegion) {
            for ($j = 0; $j < 3; $j++) {
                $region = $administrativeRegion->regions()->create([
                    'administrative_region_id' => $administrativeRegion->id,
                    'type' => $faker->randomElement(['City', 'Island']),
                    'name' => $faker->city,
                    'main_description' => $faker->paragraph(4),
                    'weather_description' => $faker->paragraph(2),
                    'card_description' => $faker->paragraph(2),
                    'card_photo' => $faker->randomElement(['images/Aljawf.png', 'images/Abha city.jpg', 'images/Alsharqia.png', 'images/Makkah.png']),
                    'is_active' => 1,
                ]);

                for ($k = 0; $k < 3; $k++) {
                    $landmark = $region->landmarks()->create([
                        'administrative_region_id' => $administrativeRegion->id,
                        'region_id' => $region->id,
                        'name' => $faker->name,
                        'description' => $faker->paragraph(1),
                        'photo' => $faker->randomElement(['images/Aljawf.png', 'images/Abha city.jpg', 'images/Alsharqia.png', 'images/Makkah.png']),
                        'location' => $faker->city,
                        'is_active' => 1,
                    ]);

                    for ($l = 0; $l < 2; $l++) {
                        $landmark->activities()->create([
                            'administrative_region_id' => $administrativeRegion->id,
                            'region_id' => $region->id,
                            'landmark_id' => $landmark->id,
                            'description' => $faker->paragraph(2),
                            'photo' => $faker->randomElement(['images/Aljawf.png', 'images/Abha city.jpg', 'images/Alsharqia.png', 'images/Makkah.png']),
                            'is_active' => 1,
                        ]);
                    }
                }
            }
        }
    }
}
