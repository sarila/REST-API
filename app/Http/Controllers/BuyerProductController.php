<?php

namespace App\Http\Controllers;

use App\Buyer;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class BuyerProductController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('scope:read-general')->only('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {

        // gives all the transactions with their product details
        // $products = $buyer->transactions()->with('product')->get();

        $products = $buyer->transactions()->with('product')->get()->pluck('product'); //selects only product fron the given or obtained collection

        return $this->showAll($products); 
    }

    
}
