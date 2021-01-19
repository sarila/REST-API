<?php 
namespace App\Scopes;

use App\Scopes\SellerScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;



/**
 * SellerScope to have global variable
 */
class SellerScope implements Scope
{
	public function apply(Builder $builder, Model $model){
		$builder->has('products');
	}
}