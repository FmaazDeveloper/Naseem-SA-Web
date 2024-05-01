<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\Region;
use App\Models\Landmark;
use App\Models\Activity;
use App\Models\Order;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Guid\Guid;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //roles and permissions
        $this->call([RolesAndPermissionsSeeder::class]);

        //user
        $this->call([UserSeeder::class]);

        //administrative region
        $this->call([AdministrativeRegionSeeder::class]);

        //contact information
        $this->call([ContactInformationSeeder::class]);

        //contact reasons
        $this->call([ContactReasonsSeeder::class]);

        //status type
        $this->call([StatusTypeSeeder::class]);

        // User::factory(10)->create();
        Region::factory(50)->create();
        Landmark::factory(100)->create();
        Activity::factory(150)->create();
        // Profile::factory(10)->create();
        // Order::factory(30)->create();
    }
}
