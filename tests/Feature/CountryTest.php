<?php

namespace Tests\Feature;

use App\Country;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountryTest extends TestCase
{
	use RefreshDatabase;

    /** @test */
    public function showCountry()
    {
    	Country::create([
        	'iso' => 've',
        	'country' => 'venezuela'
        ]);

        $this->get('/countries')
        	->assertStatus(200)
        	->assertSee('venezuela');

    }

    /** @test */
    function isNotCountries(){

        //User::truncate();

        $this->get('/countries')
            //Comprobamos que carga correctamente
            ->assertStatus(200)
            ->assertSee('No countries registered.');
    }

    /** @test */
    function itLoadsTheCountryDetailsPage(){

        //User::truncate();
        $country = country::create([
        	'iso' => 've',
        	'country' => 'venezuela'
        ]);

        $this->get('/countries/'.$country->id)
            ->assertStatus(200)
            ->assertSee('venezuela');
    }

    /** @test */
    public function itLoadstheNewCountryPage()
    {
        $this->get('countries/new')
            ->assertStatus(200)
            ->assertSee('Create new country');
    }

    /** @test */
    public function itDisplays404ErrorifTheCountryIsNotFound()
    {
        $this->get('countries/124214')
            ->assertStatus(404)
            ->assertSee('Page not found');
    }


    /** @test */
    public function itCreateNewCountry()
    {
    	$this->post('/countries/create', [
    		'iso' => 'ch',
        	'country' => 'china'
    	])->assertRedirect( route('countries.index') );

    	$this->assertDatabaseHas('countries',[
    		'iso' => 'ch',
        	'country' => 'china'
    	]);
    }

    /** @test */
    public function theCountryIsRequired()
    {

        $this->from( route('countries.new') )
            ->post('/countries/create', [
            'iso' => 'ch',
            'country' => ''
        ])->assertRedirect( route('countries.new') )
            ->assertSessionHasErrors( ['country'] );

        $this->assertDatabaseMissing('countries', [
            'iso' => 'ch'
        ]);
    }

    /** @test */
    public function theIsoIsRequired()
    {

        $this->from( route('countries.new') )
            ->post('/countries/create', [
            'iso' => '',
            'country' => 'china'
        ])->assertRedirect( route('countries.new') )
            ->assertSessionHasErrors( ['iso']);

        $this->assertEquals( 0, Country::count() );
    }

}
