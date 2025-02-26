<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'name'=>'Admin',
            'role_id'=> 1,
            'email'=>'admin@gmail.com',
            'password'=>Hash::make("secret123"),
        ]);
        User::create([
            'name'=>'Client',
            'role_id'=> 2,
            'email'=>'user@gmail.com',
            'password'=>Hash::make("secret12"),
        ]);

        for($i = 1; $i<=20; $i++){
            User::create([
                'name'=>fake()->firstName(),
                'role_id'=> 2,
                'email'=>fake()->email(),
                'password'=>fake()->password()
            ]);
        }
    }
}
