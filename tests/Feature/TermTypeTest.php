<?php

namespace Tests\Feature;

use App\PaymentTerm;
use App\TermType;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TermTypeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function showTermType()
    {
    	$this->withoutExceptionHandling();
    	
    	$payment_term = PaymentTerm::create([
    		'name' => 'unique pay 30D'
    	]);

    	TermType::create([
        	'payment_terms_id' => 1,
        	'type' => 'B',
        	'day' => 30,
        	'typeid' => 0,
        	'typeem' => 0,
        	'typenm' => 0,
        	'percentage' => 100
        ]);

    	$this->get("/payment_terms/{$payment_term->id}")
    		->assertStatus(200)
    		->assertSee('30');

    }
}
