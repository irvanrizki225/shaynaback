<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\CheckoutRequest;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;

use Illuminate\Http\Request;


class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        // $validatedData = $request->validate([
        //     'name' => 'required|max:255',
        //     'email' => 'required|email|max:255',
        //     'number' => 'required|max:255',
        //     'address' => 'required',
        //     'transaction_total' => 'required|integer',
        //     'transaction_status' => 'nullable|string|in:PENDING,SUCCESS,FAILED',
        //     'transaction_details' => 'required|array',
        //     'transaction_details.*' => 'integer|exists:products,id',
        // ]);
    
        $data = $request->except('transaction_details');
        $data['uuid'] = 'SYN' . mt_rand(10000, 99999) . mt_rand(100, 999);
        

        $transaction = Transaction::create($data);
        
        

        // foreach ($request->transaction_details as $product) 
        // {
        //     $details[] = new TransactionDetail([
        //         'transaction_id' => $transaction->id,
        //         'product_id' => $product
        //     ]);
            

        // Product::find($product)->decrement('quantity');
        // }

        foreach ($request->transaction_details as $product)
        {
            $details[] = new TransactionDetail([
                'transaction_id' => $transaction->id,
                'product_id' => $product,
            ]);

            Product::find($product)->decrement('quantity');
            
        }
        // $transaction = Transaction::all();
        $transaction->details()->saveMany($details);

        return ResponseFormater::success($transaction);
    }
    
}