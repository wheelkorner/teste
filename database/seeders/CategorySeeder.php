<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('categories')->insert([
        //     'name' => 'Remessa Parcial'
        // ]);
        // DB::table('categories')->insert([
        //     'name' => 'Remessa'
        // ]);
        DB::table('categories')->insert([
            ['name' => 'Remessa Parcial'],
            ['name' => 'Remessa'],
        ]);
    }
}
