<?php 

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;


trait ApiResponser
{
	//for json response in success of Api
	private function successResponse($data, $code)
	{
		return response()->json($data, $code);
	}

	//for json response in error
	protected function errorResponse($message, $code)
	{
		return response()->json(['error' => $message, 'code' => $code], $code);
	}

	//To show all Elements
	protected function showAll(Collection $collection, $code = 200)
	{
		if ($collection->isEmpty()) {
			return $this->successResponse(['data' => $collection], $code);
		}

		$transformer = $collection->first()->transformer;

		$collection = $this->filterData($collection, $transformer);
		$collection = $this->sortData($collection, $transformer);
		$collection = $this->transformData($collection, $transformer);

		return $this->successResponse(['data' => $collection], $code);
	}

	//To show one element
	protected function showOne(Model $instance, $code = 200)
	{
		$transformer = $instance->transformer;

		$instance = $this->transformData($instance, $transformer);
		return $this->successResponse($instance, $code);
	}

	//new method for searching and sorting of data
	protected function sortData(Collection $collection, $transformer)
	{
		if (request()->has('sort_by')) {
			$attribute = $transformer::originalAttribute(request()->sort_by);

			$collection = $collection->sortBy->{$attribute};
		}

		return $collection;
	}

	//filter data
	protected function filterData(Collection $collection, $transformer)
	{
		foreach (request()->query() as $query => $value) {
			$attribute = $transformer::originalAttribute($query);

			if (isset($attribute, $value)) {
				$collection = $collection->where($attribute, $value);
			}
		}

		return $collection;
	}

	//new method for transformation of recieved data
	protected function transformData($data, $transformer)
	{
		$transformation = fractal($data, new $transformer);
		//To return transformed data in form of array
		return $transformation->toArray();
	}
}

