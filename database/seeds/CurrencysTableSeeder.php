<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencys')->insert([
            'title' => 'СОМ',
        ]);
    }
}
