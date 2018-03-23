<?php

use App\PaymentTerm;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentTermsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentTerm::create([
        	'name' => 'balance 30 dias.'
        ]);

        PaymentTerm::create([
        	'name' => '50 por ciento 30 dias 50 por ciento 60 dias.'
        ]);

        PaymentTerm::create([
        	'name' => 'monto fijo 30 dias'
        ]);
    }
}
