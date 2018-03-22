<?php

namespace Tests\Feature;

use App\Country;
use App\State;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function showState()
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

        $this->get('states')
        	->assertStatus(200)
        	->assertSee('miranda');

    }

    /** @test */
    function isNotStates(){

        //User::truncate();

        $this->get('states')
            //Comprobamos que carga correctamente
            ->assertStatus(200)
            ->assertSee('No states registered.');
    }

    /** @test */
    public function itLoadstheNewStatePage()
    {
    	$this->withoutExceptionHandling();

        $this->get('states/new')
            ->assertStatus(200)
            ->assertSee('Create new state');
    }

    /** @test */
    public function itCreateNewState()
    {
    	$this->withoutExceptionHandling();

    	Country::create([
        	'iso' => 've',
        	'country' => 'venezuela'
        ]);

    	$this->post('/states/create', [
    		'country_id' => 1,
    		'iso' => 'mir',
        	'state' => 'miranda'
    	])->assertRedirect( route('states.index') );

    	$this->assertDatabaseHas('states',[
    		'id' => 1,
        	'state' => 'miranda'
    	]);
    }

    /** @test */
    public function theIsoIsRequired()
    {
    	Country::create([
        	'iso' => 've',
        	'country' => 'venezuela'
        ]);

        $this->from( route('states.new') )
            ->post('/states/create', [
            'iso' => '',
        	'state' => 'miranda'
        ])->assertRedirect( route('states.new') )
            ->assertSessionHasErrors( ['iso'] );

        $this->assertDatabaseMissing('states', [
            'id' => 1
        ]);
    }

    /** @test */
    public function theStateIsRequired()
    {
    	Country::create([
        	'iso' => 've',
        	'country' => 'venezuela'
        ]);

        $this->from( route('states.new') )
            ->post('/states/create', [
            'iso' => 'mir',
        	'state' => ''
        ])->assertRedirect( route('states.new') )
            ->assertSessionHasErrors( ['state'] );

        $this->assertDatabaseMissing('states', [
            'id' => 1
        ]);
    }

    /** @test */
    public function itLoadstheEditStatePage()
    {
    	Country::create([
        	'iso' => 've',
        	'country' => 'venezuela'
        ]);

    	$state = State::create([
        	'country_id' => 1,
        	'state' => 'miranda',
        	'iso' => 'mir'
        ]);

        $this->get("states/{$state->id}/edit")
            ->assertStatus(200)
            //si hay una vista llamada cities.edit
            ->assertViewIs('states.edit')
            ->assertSee('Edit State')
            //si hay una variable llamada city
            ->assertViewHas('state', function ($view_state) use ($state){
                return $view_state->id == $state->id;
            } );

    }

    /** @test */
    public function itUpdateState()
    {

        //$this->withoutExceptionHandling();

        Country::create([
        	'iso' => 've',
        	'country' => 'venezuela'
        ]);

    	$state = State::create([
        	'country_id' => 1,
        	'state' => 'miranda',
        	'iso' => 'mir'
        ]);

        $this->put("states/{$state->id}", [
            'country_id' => 1,
            'state' => 'bolivar',
        	'iso' => 'bol'
        ])->assertRedirect( route('states.index') );

    }

    /** @test */
    public function itArchivedState()
    {
        //$this->withoutExceptionHandling();

        Country::create([
            'iso' => 've',
            'country' => 'venezuela'
        ]);

        $state = State::create([
            'country_id' => 1,
            'state' => 'miranda',
            'iso' => 'mir'
        ]);

        $this->put("states/{$state->id}/archived", [
            'archived' => 1
        ])->assertRedirect( route('states.index') );

    }

    /** @test */
    public function theIsoStateUpdateIsRequired()
    {
    	Country::create([
        	'iso' => 've',
        	'country' => 'venezuela'
        ]);

        $state = State::create([
        	'country_id' => 1,
        	'state' => 'miranda',
        	'iso' => 'mir'
        ]);

        $this->from( "states/{$state->id}/edit" )
            ->put("states/{$state->id}", [
            'country_id' => 1,
            'iso' => '',
        	'state' => 'amazonas'
        ])->assertRedirect( "states/{$state->id}/edit" )
            ->assertSessionHasErrors( ['iso'] );

        $this->assertDatabaseMissing('states', [
            'state' => 'amazonas'
        ]);
    }

    /** @test */
    public function theStateStateUpdateIsRequired()
    {
    	Country::create([
        	'iso' => 've',
        	'country' => 'venezuela'
        ]);

        $state = State::create([
        	'country_id' => 1,
        	'state' => 'miranda',
        	'iso' => 'mir'
        ]);

        $this->from( "states/{$state->id}/edit" )
            ->put("states/{$state->id}", [
            'country_id' => 1,
            'iso' => 'ama',
        	'state' => ''
        ])->assertRedirect( "states/{$state->id}/edit" )
            ->assertSessionHasErrors( ['state'] );

        $this->assertDatabaseMissing('states', [
            'iso' => 'ama'
        ]);
    }
}
