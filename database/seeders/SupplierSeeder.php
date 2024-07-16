<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $faker = Faker::create();
        // foreach (range(1, 3) as $value){
        //     DB::table('suppliers')->insert([
        //     'userID' => $faker->numberBetween(4, 9),
        //     'company_name'=>$faker->name(),
        //     'commercial_register'=>$faker->name()
        // ]);
        // }
    }
}
