<?php

namespace Tests\Feature;

use App\Unit;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UnitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function showUnit()
    {
    	$this->withoutExceptionHandling();

    	Unit::create([
        	'tag' => 'Byte',
        	'quantity' => 1
        ]);

        $this->get('/units')
        	->assertStatus(200)
        	->assertSee('Byte');

    }

    /** @test */
    function isNotUnits(){

        //User::truncate();

        $this->get('/units')
            //Comprobamos que carga correctamente
            ->assertStatus(200)
            ->assertSee('No units registered.');
    }

    /** @test */
    public function itLoadstheNewUnitPage()
    {
        $this->get('units/new')
            ->assertStatus(200)
            ->assertSee('Create new unit');
    }

    /** @test */
    public function itCreateNewUnit()
    {
    	$this->post('/units/create', [
    		'tag' => 'Byte',
        	'quantity' => 1
    	])->assertRedirect( route('units.index') );

    	$this->assertDatabaseHas('units',[
    		'tag' => 'Byte',
        	'quantity' => 1
    	]);
    }

    /** @test */
    public function theTagIsRequired()
    {

        $this->from( route('units.new') )
            ->post('/units/create', [
            'tag' => '',
        	'quantity' => 1
        ])->assertRedirect( route('units.new') )
            ->assertSessionHasErrors( ['tag'] );

        $this->assertDatabaseMissing('units', [
            'tag' => 'Byte',
        	'quantity' => 1
        ]);
    }

    /** @test */
    public function theQuantityIsRequired()
    {

        $this->from( route('units.new') )
            ->post('/units/create', [
            'tag' => 'Byte',
        	'quantity' => ''
        ])->assertRedirect( route('units.new') )
            ->assertSessionHasErrors( ['quantity'] );

        $this->assertDatabaseMissing('units', [
            'tag' => 'Byte',
        	'quantity' => 1
        ]);
    }

    /** @test */
    public function itLoadstheEditUnitPage()
    {

        $unit = Unit::create([
        	'tag' => 'Byte',
        	'quantity' => 1
        ]);

        $this->get("units/{$unit->id}/edit")
            ->assertStatus(200)
            //si hay una vista llamada units.edit
            ->assertViewIs('units.edit')
            ->assertSee('Edit unit')
            //si hay una variable llamada unit
            ->assertViewHas('unit', function ($view_unit) use ($unit){
                return $view_unit->id == $unit->id;
            } );

    }

    /** @test */
    public function itUpdateUnit()
    {

        $this->withoutExceptionHandling();

        $unit = Unit::create([
        	'tag' => 'Byte',
        	'quantity' => 1
        ]);

        $this->put("units/{$unit->id}", [
            'tag' => 'Byte',
        	'quantity' => 1
        ])->assertRedirect( route('units.index') );

    }

    /** @test */
    public function itArchivedUnit()
    {
        $this->withoutExceptionHandling();

        $unit = Unit::create([
        	'tag' => 'Byte',
        	'quantity' => 1,
        	'archived' => 1
        ]);

        $this->put("units/{$unit->id}/archived", [
            'tag' => 'Byte',
        	'quantity' => 1,
        	'archived' => 0
        ])->assertRedirect( route('units.index') );

        $this->assertDatabaseHas('units',[
        	'archived' => 0
        ]);

    }

    /** @test */
    public function theQuantityUpdateIsRequired()
    {
    	$unit = Unit::create([
        	'tag' => 'Byte',
        	'quantity' => 1,
        	'archived' => 1
        ]);

        $this->from( route('units.edit', $unit->id) )
            ->put("units/{$unit->id}", [
            'tag' => 'b',
        	'quantity' => ''
        ])->assertRedirect( route('units.edit', $unit->id) )
            ->assertSessionHasErrors( ['quantity'] );

        $this->assertDatabaseMissing('units', [
            'tag' => 'b'
        ]);
    }

    /** @test */
    public function theTagUpdateIsRequired()
    {
    	$unit = Unit::create([
        	'tag' => 'Byte',
        	'quantity' => 1,
        	'archived' => 1
        ]);

        $this->from( route('units.edit', $unit->id) )
            ->put("units/{$unit->id}", [
            'tag' => '',
        	'quantity' => 4
        ])->assertRedirect( route('units.edit', $unit->id) )
            ->assertSessionHasErrors( ['tag'] );

        $this->assertDatabaseMissing('units', [
            'quantity' => 4
        ]);
    }

    /** @test */
    public function itDeleteUnit()
    {
        $this->withoutExceptionHandling();

        $unit = Unit::create([
        	'tag' => 'Byte',
        	'quantity' => 1,
        	'archived' => 1
        ]);

        $this->delete("/units/{$unit->id}")
            ->assertRedirect('units');

        $this->assertDatabaseMissing('units', [
            'id' => $unit->id
        ]);
    }
}
