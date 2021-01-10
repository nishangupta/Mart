<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function index()
    {
        return view('user.my-cart');
    }
    public function store(Request $request)
    {
        $product = Product::findOrFail($request->productId); //get product
        $user = auth()->user(); //get authenticated user

        $exists = $user->cart()->where('product_id', $request->productId)->get();
        if ($exists->count()) {
            // Alert::info('You haved already added');
            return response(['msg'=>'Already added to cart'],200);
        }

        $cart = Cart::create([
            'user_id'=>$user->id,
            'product_id'=>$product->id,
            'quantity'=>$request->quantity,
            'variant_id'=>$request->variantId,
        ]);
    
        if ($cart) {
            return response(['msg'=>'Product added to cart'],201);
        } else {
            abort(500,'Something went wrong');
        }
    }

    //mass delete
    public function destroySelected(Request $request)
    {
        $cartItems = Cart::where('user_id', auth()->user()->id)->whereIn('id', $request->cart)->get(); //get all cart ids
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
