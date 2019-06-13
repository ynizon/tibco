<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Customer;

class Quotation extends Model
{
	
    //public $timestamps = true;   
   
	public $table = 'quotations';
	
	public function user()
    {
        return $this->belongsTo('App\User');
    } 
	
	public function customer()
    {
        return $this->belongsTo('App\Customer');
    } 
}
