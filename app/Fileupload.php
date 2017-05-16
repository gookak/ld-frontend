<?php

namespace App;

class Fileupload extends Model
{
	protected $table = 'product_image';
	
	public function productImage(){
		return $this->belongsTo(ProductImage::class);
	}
}