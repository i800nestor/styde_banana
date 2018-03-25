<?php

namespace Tests\Feature;

use App\PaymentTerm;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentTermsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function showPaymentTerm()
    {
    	PaymentTerm::create([
    		'name' => 'unique pay 30D'
    	]);

    	$this->get('/payment_terms')
    		->assertStatus(200)
    		->assertSee('unique pay 30D');

    }

    /** @test */
    function isNotPaymentTerm(){

        //User::truncate();

        $this->get('/payment_terms')
            //Comprobamos que carga correctamente
            ->assertStatus(200)
            ->assertSee('No Payment Terms registered.');
    }

    /** @test */
    function itLoadsThePaymentTermDetailsPage()
    {
    	$payment_term = PaymentTerm::create([
    		'name' => 'unique pay 30D'
    	]);

    	$this->get("/payment_terms/{$payment_term->id}")
    		->assertStatus(200)
    		->assertSee('unique pay 30D');
        
    }

    /** @test */
    public function itLoadstheNewPaymentTermPage()
    {
    	$this->withoutExceptionHandling();

        $this->get('payment_terms/new')
            ->assertStatus(200)
            ->assertSee('Create new payment term');
    }

    /** @test */
    public function itCreateNewPaymentTerm()
    {
    	$this->post('/payment_terms/create', [
    		'name' => 'unique pay 30D',
    		'notes' => 'Pay unique in 30 days'
    	])->assertRedirect( route('payment_terms.index') );

    	$this->assertDatabaseHas('payment_terms',[
    		'name' => 'unique pay 30D',
    		'notes' => 'Pay unique in 30 days'
    	]);
    }

    /** @test */
    public function itLoadstheEditPaymentTerm()
    {

        $payment_term = PaymentTerm::create([
            'name' => 'unique pay 30D',
    		'notes' => 'Pay unique in 30 days'
        ]);

        $this->get("payment_terms/{$payment_term->id}/edit")
            ->assertStatus(200)
            ->assertViewIs('paymentterms.edit')
            ->assertSee('Edit Payment Term')
            ->assertViewHas('payment_term', function ($view_payment_term) use ($payment_term){
                return $view_payment_term->id == $payment_term->id;
            } );

    }

    /** @test */
    public function itUpdatePaymentTerm()
    {

        //$this->withoutExceptionHandling();

        $payment_term = PaymentTerm::create([
            'name' => 'unique pay 30D',
    		'notes' => 'Pay unique in 30 days'
        ]);

        $this->put("payment_terms/{$payment_term->id}", [
            'name' => 'unique 30D',
    		'notes' => 'Pay in 30 days'
        ])->assertRedirect( route('payment_terms.index') );

    }

    /** @test */
    public function itDeletePaymentTerm()
    {
        $this->withoutExceptionHandling();

        $payment_term = PaymentTerm::create([
            'name' => 'unique pay 30D',
    		'notes' => 'Pay unique in 30 days'
        ]);

        $this->delete("payment_terms/{$payment_term->id}")
            ->assertRedirect('payment_terms');

        $this->assertDatabaseMissing('payment_terms', [
            'id' => $payment_term->id
        ]);
    }
}
