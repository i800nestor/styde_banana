<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->truncateTables([
    		'countries',
    		'cities',
    		'states',
    		'currencies',
            'payment_terms',
            'term_types',
            'units'
    	]);

        // $this->call(UsersTableSeeder::class);

        $this->call(CountriesSeeder::class);
        $this->call(StatesSeeder::class);
        $this->call(CitiesSeeder::class);
        $this->call(CurrenciesSeeder::class);
        $this->call(PaymentTermsSeeder::class);
        $this->call(TermTypesSeeder::class);
        $this->call(UnitsSeeder::class);
    }

    protected function truncateTables(array $tables){

    	DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

    	foreach ($tables as $table) {
    		
    		DB::table($table)->truncate();

    	}

    	DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

    }
}
