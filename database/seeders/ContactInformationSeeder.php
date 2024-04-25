<?php

namespace Database\Seeders;

use App\Models\ContactInformation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactInformation::create([
            'email' => 'Naseem-SA@gmail.com',
            'phone_number' => '+966 56 327 2784',
            'location' => 'KSA - Riyadh city',
        ]);
    }
}
