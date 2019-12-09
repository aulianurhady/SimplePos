<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class TransactionController extends Controller
{
    public function addOrder()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        return view('transaksi.add', compact('products'));
    }

    public function getProduct($id)
    {
        $products = Product::findOrFail($id);
        return response()->json($products, 200);
    }
}
