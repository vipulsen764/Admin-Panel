<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmplyoeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Employees')->insert([
            'First_name' => Str::random(10),
            'last_name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'phone' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
            'Company_id' => rand(1,10),
        ]);
    }
}
