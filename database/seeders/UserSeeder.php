<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
            'name' => 'Kctek',
            'surname' => 'Arge',
            'phone' => '0507 000 00 00',
            'email' => 'db_backup_kctek@gmail.com',
            'password' => Hash::make('kctek2023'),
            'decryptPassword' => 'kctek2023'
        ]);
    }
}

// $ php artisan db:seed --class=UserSeeder