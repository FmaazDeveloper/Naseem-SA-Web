<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Mohammad Alzahrani',
            'email' => 'coldhot44juse@gmail.com',
            'password' => bcrypt('11111111'),
        ]);

        $user->assignRole('admin');
    }
}
