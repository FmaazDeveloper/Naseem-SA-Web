<?php

namespace Database\Seeders;

use App\Models\ContactReasons;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactReasonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //Information Request
        ContactReasons::create([
            'admin_id' => 1,
            'name' => 'Information Request',
        ]);

        //Submit a complaint
        ContactReasons::create([
            'admin_id' => 1,
            'name' => 'Submit a complaint',
        ]);

        //Website Troubles
        ContactReasons::create([
            'admin_id' => 1,
            'name' => 'Website Troubles',
        ]);

        //General Assistance and Guidance
        ContactReasons::create([
            'admin_id' => 1,
            'name' => 'General Assistance and Guidance',
        ]);

    }
}
