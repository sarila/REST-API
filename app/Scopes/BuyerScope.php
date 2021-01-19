<?php 
namespace App\Scopes;

use App\Scopes\BuyerScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;



/**
 * BuyerScope to have global variable
 */
class BuyerScope implements Scope
{
	public function apply(Builder $builder, Model $model){
		$builder->has('transactions');
	}
}