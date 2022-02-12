<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Cassiano Cavalheiro Fernandes',
            'email' => 'cassiano_tst@hotmail.com',
            'password' => Hash::make('senha123'),
        ]);
    }
}
