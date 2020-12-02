<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use Auth;
use App\Product;


class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        return view('cart.index', compact('carts'));
    }

    public function store(Request $request)
    {
        //supaya tidak ada product yang sama di cart(duplicate)
        $duplicate = Cart::where('product_id', $request->product_id)->first();
        if($duplicate) {
            return redirect('/cart')->with('error', 'Barang sudah ada di cart !');
        }



        Cart::create([
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
            'qty' => 1
        ]);
        return redirect('/cart')->with('success', 'Sukses menambah barang di cart');
    }

    public function update(Request $request, $id)
    {
        Cart::where('id', $id)->update([
            'qty' => $request->quantity
        ]);
        return response()->json([
            'success' => true
        ]);
    }
}