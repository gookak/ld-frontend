<?php

namespace App;

class Order extends Model
{
	protected $table = 'order';

	public function detail() {
		return $this->hasMany(OrderDetail::class);
	}
}
