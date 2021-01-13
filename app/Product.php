<?php

namespace App;

use App\Seller;
use App\Transaction;
use App\Category;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	const AVAILABLE_PRODUCT = 'available';
	const UNAVAILABLE_PRODUCT = 'unavailable';

	protected $fillable =[
		'name',
		'description',
		'quantity',
		'status',
		'image',
		'selelr_id',
	];

	public function isAvailable(){
		return $this->status == Product::AVAILABLE_PRODUCT;
	}
	public function seller()
	{
		return $this->belongsTo(Seller::class);
	}

	public function transactions()
	{
		return $this->belongsTo(Transaction::class);
	}

	public function categories(){
		 return $this->belongsToMany(Category::class);
	}


}