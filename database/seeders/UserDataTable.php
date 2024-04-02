<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserDataTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
              'name' => 'Geric Morit',
              'email' => 'gericmorit3211@gmail',
              'password' => '12345',
              'usertype' => 'user',
              'created_at' => '2024-03-29 03:56:26',
              'updated_at' => '2024-03-29 03:56:26',
              'status' => 'activated', // Enclose 'activated' in quotes
            ],
            [
                'name' => 'Tj Medinose',
              'email' => 'tjmedina3211@gmail',
              'password' => '12345',
              'usertype' => 'user',
              'created_at' => '2024-03-29 03:57:00',
              'updated_at' => '2024-03-29 03:57:00',
              'status' => 'activated', // Enclose 'activated' in quotes
            ],
            [
                'name' => 'Bryan Batan',
              'email' => 'bryanbatan@gmail',
              'password' => '12345',
              'usertype' => 'user',
              'created_at' => '2024-03-29 03:56:40',
              'updated_at' => '2024-03-29 03:56:40',
              'status' => 'activated', // Enclose 'activated' in quotes
            ],
            [
                'name' => 'Mico Gianan',
              'email' => 'micog1@gmail',
              'password' => '12345',
              'usertype' => 'user',
              'created_at' => '2024-03-30 03:10:41',
              'updated_at' => '2024-03-30 03:10:41',
              'status' => 'activated', // Enclose 'activated' in quotes
            ],
            [
                'name' => 'Arnel Bullo',
              'email' => 'arnelbullo@gmail',
              'password' => '12345',
              'usertype' => 'user',
              'created_at' => '2024-03-30 04:53:21',
              'updated_at' => '2024-03-30 04:53:21',
              'status' => 'activated', // Enclose 'activated' in quotes
            ]
        ]);
    }
}
