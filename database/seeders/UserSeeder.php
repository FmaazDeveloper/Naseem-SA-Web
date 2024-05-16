<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

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
            'role' => 'manager',
        ]);

        $user->profile()->create([
            'user_id' => $user->id,
        ]);

        $user->assignRole('manager');
        $user->givePermissionTo(Permission::all());
    }
}
