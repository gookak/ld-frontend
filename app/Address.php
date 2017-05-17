<?php

namespace App;

class Address extends Model
{
	protected $table = 'address';
	
	public function user(){
		return $this->belongsTo(User::class);
	}

}