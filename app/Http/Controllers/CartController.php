<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $product = Product::findOrFail($request->product_id);

        $exists = $user->cart()
            ->where('product_id', $request->product_id)
            ->get();

        if ($exists->count()) {
            Alert::info('You haved already added');
            return Redirect::to($product->path());
        }

        $cart = new Cart();
        $cart->user_id = Auth::user()->getAuthIdentifier();
        $cart->product_id = $product->id;
        $cart->quantity = $request->quantity;

        if ($cart->save()) {
            Alert::toast('Product added to cart!');
        } else {
            Alert::toast('Something went wrong');
        }

        return Redirect::route('cart.index');
    }

    //mass delete
    public function destroySelected(Request $request): array
    {
        $cartItems = Cart::where('user_id', auth()->user()->id)->whereIn('id', $request->cart)->get();

        foreach ($cartItems as $item) {
            $item->delete();
        }

        return ['delete' => "success"];
    }

    public function all()
    {
        $id = Auth::user()->getAuthIdentifier();

        return Cart::where('user_id', $id)
            ->with('product.getImage')
            ->get();
    }
}
