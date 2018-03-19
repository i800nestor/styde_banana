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

    /** @test */
    public function itLoadstheEditCityPage()
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

        $city = City::create([
            'state_id' => 1,
        	'city' => 'petare'
        ]);

        $this->get("cities/{$city->id}/edit")
            ->assertStatus(200)
            //si hay una vista llamada cities.edit
            ->assertViewIs('cities.edit')
            ->assertSee('Edit City')
            //si hay una variable llamada city
            ->assertViewHas('city', function ($view_city) use ($city){
                return $view_city->id == $city->id;
            } );

    }

    /** @test */
    public function itUpdateCity()
    {

        //$this->withoutExceptionHandling();

        Country::create([
        	'iso' => 've',
        	'country' => 'venezuela'
        ]);

    	State::create([
        	'country_id' => 1,
        	'state' => 'miranda',
        	'iso' => 'mir'
        ]);

        $city = City::create([
            'state_id' => 1,
        	'city' => 'petare'
        ]);

        $this->put("cities/{$city->id}", [
            'state_id' => 1,
            'city' => 'antimano',
            'capital' => 1
        ])->assertRedirect( route('cities.index') );

    }

    /** @test */
    public function itArchivedCity()
    {
        //$this->withoutExceptionHandling();

        Country::create([
            'iso' => 've',
            'country' => 'venezuela'
        ]);

        State::create([
            'country_id' => 1,
            'state' => 'miranda',
            'iso' => 'mir'
        ]);

        $city = City::create([
            'state_id' => 1,
            'city' => 'petare',
            'archived' => 0
        ]);

        $this->put("cities/{$city->id}/archived", [
            'archived' => 1
        ])->assertRedirect( route('cities.index') );

    }

    /** @test */
    public function theCityUpdateIsRequired()
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

        $city = City::create([
            'state_id' => 1,
            'city' => 'petare',
        ]);

        $this->from( "cities/{$city->id}/edit" )
            ->put("/cities/{$city->id}", [
            'state_id' => 1,
            'city' => '',
            'capital' => 1
        ])->assertRedirect( "cities/{$city->id}/edit" )
            ->assertSessionHasErrors( ['city'] );

        $this->assertDatabaseMissing('cities', [
            'capital' => 1
        ]);
    }

    /** @test */
    public function theStateIdUpdateIsRequired()
    {
        //$this->withoutExceptionHandling();

        Country::create([
            'iso' => 've',
            'country' => 'venezuela'
        ]);

        State::create([
            'country_id' => 1,
            'state' => 'miranda',
            'iso' => 'mir'
        ]);

        State::create([
            'country_id' => 1,
            'state' => 'bolivar',
            'iso' => 'bo'
        ]);

        $city = City::create([
            'state_id' => 1,
            'city' => 'petare',
        ]);

        $this->from( "cities/{$city->id}/edit" )
            ->put("/cities/{$city->id}", [
            'state_id' => '',
            'city' => 'upata',
            'capital' => 1
        ])->assertRedirect( "cities/{$city->id}/edit" )
            ->assertSessionHasErrors( ['state_id'] );

        $this->assertDatabaseMissing('cities', [
            'city' => 'upata'
        ]);
    }

    /** @test */
    public function itDeleteCity()
    {
        //$this->withoutExceptionHandling();

        Country::create([
            'iso' => 've',
            'country' => 'venezuela'
        ]);

        State::create([
            'country_id' => 1,
            'state' => 'miranda',
            'iso' => 'mir'
        ]);

        $city = City::create([
            'state_id' => 1,
            'city' => 'petare',
        ]);

        $this->delete("cities/{$city->id}")
            ->assertRedirect('cities');

        $this->assertDatabaseMissing('cities', [
            'id' => $city->id
        ]);
    }
}
