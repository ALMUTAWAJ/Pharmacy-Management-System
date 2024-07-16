<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $faker = Faker::create();
        // foreach (range(1, 3) as $value){
        //     DB::table('products')->insert([
        //     'name' => $faker->name(),
        //     'image' => 'prod',
        //     'price' => '1.5',
        //     'category' => 'BabyCare',
        //     'description' => 'anything about the products',
        //     'prescription_req' => '0',
        //     'supplierID' => '3',
        // ]);
        // }
    }
}
