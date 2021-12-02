<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Mg1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mg1')->insert([
           ['name' => 'test1'],
           ['name' => 'test2'],
           ['name' => 'test3'],
           ['name' => 'test4'],
        ]);
    }
}
