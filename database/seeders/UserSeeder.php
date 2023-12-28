<?php
namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach (range(1, 10) as $value){
            DB::table('users')->insert([
            'username' => $faker->name(),
            'email' => $faker->email,
            'phone_number' => $faker->phoneNumber(),
            'password' => Hash::make($faker->password()),
            'role' => 'customer',
        ]);
        }
    }
}
