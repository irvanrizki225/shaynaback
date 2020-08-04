<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function all(Request $request)
    {
        $id =$request->input('id');
        $limit =$request->input('limit', 6);
        $name =$request->input('name');
        $slug =$request->input('slug');
        $type =$request->input('type');
        $price_from =$request->input('price_from');
        $price_to =$request->input('price_to');

        if($id)
        {
            $product = Product::with('galleries')->find($id);

            if($product)
            
                return ResponseFormater::success($product, 'Data Product Berhasil Di Ambil');
            else
                return ResponseFormater::error(null, 'Data Product Tidak Ada', 404);
        }
        if($slug)
        {
            $product = Product::with('galleries')->find($slug)
            ->where('slug', $slug)
            ->first();

            if($product)
            
                return ResponseFormater::success($product, 'Data Product Berhasil Di Ambil');
            else
                return ResponseFormater::error(null, 'Data Product Tidak Ada', 404);
        }

        $product = Product::with('galleries');

        if($name)
            $product->where('name','like', '%'. $name .'%' );
        if($type)
            $product->where('type','like', '%'. $type .'%' );
        if($price_from)
            $product->where('price','>=',  $price_from );
        if($price_to)
            $product->where('price', '<=', $price_to );

        return ResponseFormater::success(
            $product->paginate($limit),
            'Data List Sudah Berhasil Diambil'
        );
    }
}
