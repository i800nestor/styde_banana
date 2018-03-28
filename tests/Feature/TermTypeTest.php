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
    	//$this->withoutExceptionHandling();
    	
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

    /** @test */
    function isNotTermType(){

        $payment_term = PaymentTerm::create([
    		'name' => 'unique pay 30D'
    	]);

        $this->get("/payment_terms/{$payment_term->id}")
            //Comprobamos que carga correctamente
            ->assertStatus(200)
            ->assertSee('No Terms Types registered.');
    }

    /** @test */
    public function itLoadstheNewTermTypePage()
    {
    	$this->withoutExceptionHandling();

    	$payment_term = PaymentTerm::create([
    		'name' => 'unique pay 30D'
    	]);

        $this->get("term_types/{$payment_term->id}/new")
            ->assertStatus(200)
            ->assertSee('Create term type');
    }

    /** @test */
    public function itCreateNewTermType()
    {
        $this->withoutExceptionHandling();

        $payment_term = PaymentTerm::create([
            'name' => 'unique pay 30D'
        ]);

        $this->post('/term_types/create', [
            'payment_terms_id' => 1,
            'type' => 'M',
            'day' => 0,
            'typeid' => 0,
            'typeem' => 0,
            'typenm' => 0,
            'fixed_amount' => 1500000,
            'percentage' => 0,
            'daydxpp' => 0,
            'percentdxpp' => 0
        ])->assertRedirect( route('payment_terms.show', 1) );

        $this->assertDatabaseHas('term_types',[
            'type' => 'M'
        ]);
    }

    /** @test */
    public function itLoadstheEditTermType()
    {

        $payment_term = PaymentTerm::create([
            'name' => 'unique pay 30D',
            'notes' => 'Pay unique in 30 days'
        ]);

        $term_type = TermType::create([
            'payment_terms_id' => 1,
            'type' => 'M',
            'day' => 0,
            'typeid' => 0,
            'typeem' => 0,
            'typenm' => 0,
            'fixed_amount' => 1500000,
            'percentage' => 0,
            'daydxpp' => 0,
            'percentdxpp' => 0
        ]);

        $this->get("term_types/{$payment_term->id}/{$term_type->id}/edit")
            ->assertStatus(200)
            ->assertViewIs('termtypes.edit')
            ->assertSee('Edit Term Type')
            ->assertViewHas('term_type', function ($view_term_type) use ($term_type){
                return $view_term_type->id == $term_type->id;
            } );

    }

    /** @test */
    public function itUpdateTermType()
    {

        $this->withoutExceptionHandling();

        $payment_term = PaymentTerm::create([
            'name' => 'unique pay 30D',
            'notes' => 'Pay unique in 30 days'
        ]);

        $term_type = TermType::create([
            'payment_terms_id' => 1,
            'type' => 'M',
            'day' => 0,
            'typeid' => 0,
            'typeem' => 0,
            'typenm' => 0,
            'fixed_amount' => 1500000,
            'percentage' => 0,
            'daydxpp' => 0,
            'percentdxpp' => 0
        ]);

        $this->put("term_types/{$term_type->id}", [
            'payment_terms_id' => 1,
            'type' => 'B',
            'day' => 0,
            'typev' => 'typeid',
            'fixed_amount' => 0,
            'percentage' => 0,
            'daydxpp' => 0,
            'percentdxpp' => 0
        ])->assertRedirect( route('payment_terms.show', 1) );

    }
}
