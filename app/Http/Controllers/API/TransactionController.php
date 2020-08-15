<?php

namespace App\Http\Controllers\API;

use App\Models\Transaction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function get(Request $request, $id)
    {
        $product = Transaction::with(['details.product'])->find($id);

        if($product)
            return ResponseFormater::success($product, 'Data Berhasil Di ambil');
        else
            return ResponseFormater::error($product, 'Data Tidak Ada', 404); 
    }
}
