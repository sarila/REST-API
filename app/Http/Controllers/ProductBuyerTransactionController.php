<?php

namespace App\Http\Controllers;

use App\Buyer;
use App\Http\Controllers\ApiController;
use App\Product;
use App\Transaction;
use App\Transformers\TransactionTransformer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductBuyerTransactionController extends ApiController
{

    public function __construct()
    {
        parent::__construct();

        $this->middleware('transform.input:' . TransactionTransformer::class)->only(['store']);
        $this->middleware('scope:purchase-product')->only(['store']);
    }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product, $user)
    {
        $rules =[
            'quantity' => 'integer|required|min:1'
        ];
        $this->validate($request, $rules);
        $buyer = User::findOrFail($user);

        if ($buyer->id == $product->seller_id) {
            return $this->errorResponse('The buyer must be different from seller', 409);
        }
        if (!$buyer->isVerified()) {
            return $this->errorResponse('The buyer must be verified', 409);
        }
        if (!$product->seller->isVerified()) {
            return $this->errorResponse('The seller must be verified', 409);
        }
        if (!$product->isAvailable()) {
            return $this->errorResponse('The product is not available', 409);
        }
        if ($product->quantity < $request->quantity) {
            return $this->errorResponse('The quatity exceeds the availability of product', 409);
        }
        return DB::transaction(function() use($request, $product, $buyer) {
            $product->quantity -= $request->quantity;
            $product->save();

            $transaction = Transaction::create([
                'quantity' => $request->quantity,
                'product_id' => $product->id,
                'buyer_id' => $buyer->id,
            ]);

            return $this->showOne($transaction);
        });

    }

    
}
