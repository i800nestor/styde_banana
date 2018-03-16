<?php

namespace Tests\Feature;

use App\Country;
use App\State;
use App\City;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function showCity()
    {
    	Country::create([
        	'iso' => 've',
        	'country' => 'venezuela'
        ]);

    	State::create([
        	'country_id' => 1,
        	'state' => 'miranda',
        	'iso' => 'mir'
        ]);

    	City::create([
        	'state_id' => 1,
        	'city' => 'caracas',
        	'capital' => true
        ]);

        $this->get('cities')
        	->assertStatus(200)
        	->assertSee('caracas');

    }

    /** @test */
    function isNotCities(){

        //User::truncate();

        $this->get('cities')
            //Comprobamos que carga correctamente
            ->assertStatus(200)
            ->assertSee('No cities registered.');
    }

    /** @test */
    public function itLoadstheNewCityPage()
    {
    	$this->withoutExceptionHandling();

        $this->get('cities/new')
            ->assertStatus(200)
            ->assertSee('Create new city');
    }

    /** @test */
    public function itCreateNewCity()
    {
    	$this->withoutExceptionHandling();

    	Country::create([
        	'iso' => 've',
        	'country' => 'venezuela'
        ]);

    	State::create([
        	'country_id' => 1,
        	'state' => 'miranda',
        	'iso' => 'mir'
        ]);

    	$this->post('/cities/create', [
    		'state_id' => 1,
        	'city' => 'caracas',
        	'capital' => true
    	])->assertRedirect( route('cities.index') );

    	$this->assertDatabaseHas('cities',[
    		'state_id' => 1,
        	'city' => 'caracas'
    	]);
    }

    /** @test */
    public function theCityIsRequired()
    {
    	Country::create([
        	'iso' => 've',
        	'country' => 'venezuela'
        ]);

    	State::create([
        	'country_id' => 1,
        	'state' => 'miranda',
        	'iso' => 'mir'
        ]);

        $this->from( route('cities.new') )
            ->post('/cities/create', [
            'state_id' => 1,
        	'city' => ''
        ])->assertRedirect( route('cities.new') )
            ->assertSessionHasErrors( ['city'] );

        $this->assertDatabaseMissing('cities', [
            'state_id' => 1
        ]);
    }

    /** @test */
    public function theStateIdIsRequired()
    {
    	Country::create([
        	'iso' => 've',
        	'country' => 'venezuela'
        ]);

    	State::create([
        	'country_id' => 1,
        	'state' => 'miranda',
        	'iso' => 'mir'
        ]);

        $this->from( route('cities.new') )
            ->post('/cities/create', [
            'state_id' => '',
        	'city' => 'petare'
        ])->assertRedirect( route('cities.new') )
            ->assertSessionHasErrors( ['state_id'] );

        $this->assertDatabaseMissing('cities', [
            'city' => 'petare'
        ]);
    }
}
