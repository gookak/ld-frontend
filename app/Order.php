<?php

namespace App;

class Order extends Model
{
	protected $table = 'order';

	public function user() {
		return $this->belongsTo(User::class);
	}

    public function transportstatus() {
        return $this->belongsTo(TransportStatus::class);
    }

    public function orderdetail() {
        return $this->hasMany(OrderDetail::class);
    }
}
