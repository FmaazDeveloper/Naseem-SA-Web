<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Order;
use App\Models\Ticket;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        //contact reasons
        $this->call([ContactReasonsSeeder::class]);

        //contents
        $this->call([ContentSeeder::class]);

        //profile
        // Profile::factory(20)->create();

        //order
        // Order::factory(100)->create();

        //ticket
        // Ticket::factory(100)->create();

    }
}
