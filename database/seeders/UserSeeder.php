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
        // create, bulk(insert)
        User::create([
            'name' => 'renz',
            'email' => 'renz@gmail.com',
            'password' => '123456798',
            'role_id' => 1,
        ]);
    }
}
