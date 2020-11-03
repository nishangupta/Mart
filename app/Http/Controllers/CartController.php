<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\RouteRoleTrait;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    use RouteRoleTrait;

    public function __construct()
    {
        $this->middleware('role:user');
    }
    public function index()
    {
        return view('user.my-cart');
    }
    public function store(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $user = auth()->user();

        $exists = $user->cart()->where('product_id', $request->product_id)->get();
        if ($exists->count()) {
            Alert::info('You haved already added');
            return redirect(route('shop.show', ['id' => $request->product_id]));
        }

        $cart = new Cart();
        $cart->user_id = auth()->user()->id;
        $cart->product_id = $product->id;
        $cart->quantity = $request->quantity ?? 1;
        if ($cart->save()) {
            Alert::toast('Product added to cart!');
        } else {
            Alert::toast('Something went wrong');
        }

        return redirect()->route('cart.index');
    }

    //mass delete
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
