<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'John',
            'email' => 'John123@mails.ru',
            'password' => Hash::make('123')
        ]);

        $user2 = User::create([
            'name' => 'Alisher',
            'email' => 'eshmurodov.alisher@inbox.ru',
            'password' => Hash::make('1111')
        ]);

        $user->roles()->attach([1, 3]);
        $user2->roles()->attach(2);

//        User::factory(10)->create();

    }
}
