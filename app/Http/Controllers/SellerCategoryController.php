<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Seller;
use Illuminate\Http\Request;

class SellerCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
        $categories = $seller->products()
        ->with('categories')
        ->whereHas('categories')
        ->get()
        ->pluck('categories')
        ->collapse()
        ->unique('id')
        ->values();

        return $this->showAll($categories);
    }

}
