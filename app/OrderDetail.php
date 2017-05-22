<?php

namespace App;

class OrderDetail extends Model
{
	protected $table = 'order_detail';

	public function order() {
        return $this->belongsTo(Order::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}