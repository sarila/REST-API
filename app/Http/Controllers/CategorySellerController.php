<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class CategorySellerController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $this->allowedAdminAction();
        $seller = $category->products()->with('seller')->get()
        ->pluck('seller')
        ->unique()
        ->values();

        return $this->showAll($seller);
    }

   
}
