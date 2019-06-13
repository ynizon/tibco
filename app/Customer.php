<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Quotation;

class Customer extends Model
{
	
    //public $timestamps = true;   
   
	public $table = 'customers';
	
	public function quotations()
    {
        return $this->hasMany('App\Quotation');
    } 
}
