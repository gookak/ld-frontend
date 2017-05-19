<?php

namespace App;

class TransportStatus extends Model
{
	protected $table = 'transport_status';

	public function order() {
		return $this->hasMany(Order::class);
	}
}
