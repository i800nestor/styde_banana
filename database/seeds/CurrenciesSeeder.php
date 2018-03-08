<?php

use App\Currency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create([
        	'isocode' => 'bsf',
        	'language' => 'spa',
        	'money' => 'bolivares',
        	'symbol' => '$'
        ]);

        Currency::create([
        	'isocode' => 'pes',
        	'language' => 'spa',
        	'money' => 'pesos',
        	'symbol' => '$'
        ]);

        Currency::create([
        	'isocode' => 'sol',
        	'language' => 'spa',
        	'money' => 'soles',
        	'symbol' => '$'
        ]);
    }
}
