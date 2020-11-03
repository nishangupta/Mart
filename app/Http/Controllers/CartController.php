<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        return view('user.my-cart');
    }
    public function show()
    {
        return view('user.my-cart');
    }
    public function store()
    {
        return view('user.my-cart');
    }
    public function update()
    {
        return view('user.my-cart');
    }

    public function destroySelected(Request $request)
    {
        $cartItems = Cart::where('user_id', auth()->user()->id)->whereIn('id', $request->cart)->get();
        foreach ($cartItems as $item) {
            $item->delete();
        }
        return ['delete' => "success"];
    }

    public function all()
    {
        $cartItems = Cart::where('user_id', auth()->user()->id)->with('product.getImage')->get();

        return $cartItems;
    }
}
