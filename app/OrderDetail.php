<?php

namespace App;

class OrderDetail extends Model
{
	protected $table = 'order_detail';

	public function detail() {
		return $this->belongsTo(Order::class);
	}
}
