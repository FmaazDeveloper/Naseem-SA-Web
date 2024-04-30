<?php

namespace Database\Seeders;

use App\Models\AdministrativeRegion;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdministrativeRegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Riyadh
        AdministrativeRegion::create([
            'admin_id' => 1,
            'name' => 'Riyadh',
            'photo' => '/images/administrative_regions/Riyadh.png',
        ]);

        //Makkah
        AdministrativeRegion::create([
            'admin_id' => 1,
            'name' => 'Makkah',
            'photo' => '/images/administrative_regions/Makkah.png',
        ]);

        //AL Madinah AL Munawwarah
        AdministrativeRegion::create([
            'admin_id' => 1,
            'name' => 'AL Madinah AL Munawwarah',
            'photo' => '/images/administrative_regions/AL Madinah AL Munawwarah.png',
        ]);

        //Al-Qassim
        AdministrativeRegion::create([
            'admin_id' => 1,
            'name' => 'Al-Qassim',
            'photo' => '/images/administrative_regions/Al-Qassim.png',
        ]);

        //Alsharqia
        AdministrativeRegion::create([
            'admin_id' => 1,
            'name' => 'Alsharqia',
            'photo' => '/images/administrative_regions/Alsharqia.png',
        ]);

        //Asir
        AdministrativeRegion::create([
            'admin_id' => 1,
            'name' => 'Asir',
            'photo' => '/images/administrative_regions/Asir.png',
        ]);


        //Tabuk
        AdministrativeRegion::create([
            'admin_id' => 1,
            'name' => 'Tabuk',
            'photo' => '/images/administrative_regions/Tabuk.png',
        ]);


        //Hail
        AdministrativeRegion::create([
            'admin_id' => 1,
            'name' => 'Hail',
            'photo' => '/images/administrative_regions/Hail.png',
        ]);


        //Alhudud Alshamalia
        AdministrativeRegion::create([
            'admin_id' => 1,
            'name' => 'Alhudud Alshamalia',
            'photo' => '/images/administrative_regions/Alhudud Alshamalia.png',
        ]);


        //Jazan
        AdministrativeRegion::create([
            'admin_id' => 1,
            'name' => 'Jazan',
            'photo' => '/images/administrative_regions/Jazan.png',
        ]);


        //Najran
        AdministrativeRegion::create([
            'admin_id' => 1,
            'name' => 'Najran',
            'photo' => '/images/administrative_regions/Najran.png',
        ]);


        //Al-Baha
        AdministrativeRegion::create([
            'admin_id' => 1,
            'name' => 'Al-Baha',
            'photo' => '/images/administrative_regions/Al-Baha.png',
        ]);


        //Aljawf
        AdministrativeRegion::create([
            'admin_id' => 1,
            'name' => 'Aljawf',
            'photo' => '/images/administrative_regions/Aljawf.png',
        ]);

    }
}
