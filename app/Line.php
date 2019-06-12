<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
	
    //public $timestamps = true;   
   
	public $table = 'lines';
	public $fillable = ["title","description","points"];
}
