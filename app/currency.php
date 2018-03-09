<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class currency extends Model
{
    //protected $table = 'currencies';
    protected $fillable = ['isocode', 'language', 'money', 'symbol'];
}
