<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'title' => 'Доход',
            'icon' => 'икон',
            'color' => '#ffff',
        ]);
        DB::table('categories')->insert([
            'title' => 'Расход',
            'icon' => 'икон2',
            'color' => '#fff2',
        ]);
    }
}
