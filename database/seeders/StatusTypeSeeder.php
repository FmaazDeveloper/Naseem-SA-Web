<?php

namespace Database\Seeders;

use App\Models\StatusType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //New
        StatusType::create([
            'admin_id' => 1,
            'name' => 'New',
        ]);

        //Closed
        StatusType::create([
            'admin_id' => 1,
            'name' => 'Closed',
        ]);

        //Actived
        StatusType::create([
            'admin_id' => 1,
            'name' => 'Actived',
        ]);

        //Pending
        StatusType::create([
            'admin_id' => 1,
            'name' => 'Pending',
        ]);

        //Completed
        StatusType::create([
            'admin_id' => 1,
            'name' => 'Completed',
        ]);

        //Canceled
        StatusType::create([
            'admin_id' => 1,
            'name' => 'Canceled',
        ]);
    }
}
