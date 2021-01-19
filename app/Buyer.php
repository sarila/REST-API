<?php

namespace App;

use App\Scopes\BuyerScope;
use App\Transaction;
use App\User;


class Buyer extends User
{
	//Accessing global scope
	protected static function boot(){
		parent::boot();

		static::addGlobalScope(new BuyerScope);
	}

    public function transactions()
    {
    	return $this->hasMany(Transaction::class);
    }
}
