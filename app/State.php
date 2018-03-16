<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    //protected $table = 'states';
    protected $fillable = ['country_id', 'iso', 'state', 'archived'];
}
