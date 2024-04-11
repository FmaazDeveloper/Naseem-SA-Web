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
        $this->call(LaratrustSeeder::class);

        User::factory(100)->create();
        Profile::factory(100)->create();
        Region::factory(20)->create();
        Landmark::factory(100)->create();
        Activity::factory(150)->create();
        Order::factory(30)->create();
    }
}
