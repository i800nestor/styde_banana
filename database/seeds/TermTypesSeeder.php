<?php

use App\TermType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TermType::create([
        	'paymentterms_id' => 1,
        	'type' => 'B',
        	'day' => 30,
        	'typeid' => 0,
        	'typeem' => 1,
        	'typenm' => 0,
        	'percentage' => 100
        ]);

        TermType::create([
        	'paymentterms_id' => 2,
        	'type' => 'P',
        	'day' => 30,
        	'typeid' => 0,
        	'typeem' => 1,
        	'typenm' => 0,
        	'percentage' => 50
        ]);

        TermType::create([
        	'paymentterms_id' => 2,
        	'type' => 'P',
        	'day' => 60,
        	'typeid' => 0,
        	'typeem' => 1,
        	'typenm' => 0,
        	'percentage' => 50
        ]);
    }
}
