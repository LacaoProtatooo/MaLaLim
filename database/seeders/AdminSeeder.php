<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $defaultEmail = 'admin@gmail.com';
        $defaultBirthdate = $faker->date($format = 'Y-m-d', $max = 'now');

        // Creating a new user
        $user = User::create([
            'fname' => 'AdminFN',
            'lname' => 'AdminLN',
            'phone_number' => $faker->phoneNumber,
            'email' => $defaultEmail,
            'address' => 'TUP-TAGUIG',
            'birthdate' => $defaultBirthdate,
            'password' => Hash::make('123123123'),
        ]);

        // Creating a new role for the user
        Role::create([
            'user_id' => $user->id,
            'title' => 'admin',
        ]);

        $user->createToken('auth_token')->plainTextToken;
    }
}
