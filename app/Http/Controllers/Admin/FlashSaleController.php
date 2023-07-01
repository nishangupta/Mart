<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class FlashSaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }
    public function index()
    {
        return view('admin.flash-sale.index');
    }
    public function create()
    {
        return view('admin.flash-sale.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_code' => 'required',
            'flash_price' => 'required',
        ]);

        $product = Product::where('product_code', $request->product_code)->first();
        if (!$product) {
            Alert::toast('Product not found!', 'error');
            return redirect(route('flashSale.create'));
        }
        //flash price should be less than the actual price
        if ($request->flash_price > $product->price) {
            $request->flash_price = $product->price;
        }

        $flashSale = new FlashSale();
        $flashSale->product_id = $product->id;
        $flashSale->flash_price = $request->flash_price;
        $flashSale->save();

        Alert::toast('Added', 'success');
        return redirect(route('flashSale.index'));
    }

    public function edit(FlashSale $id)
    {
        //here the id become an instance of flashsale
        $product = Product::where('id', $id->product_id)->with('productImage')->first();
        return view('admin.flash-sale.edit')->with([
            'flashSale' => $id, //here the id is an instance of flashsale
            'product' => $product,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'flash_price' => 'required'
        ]);

        $flashSale = FlashSale::findOrFail($id);
        $flashSale->flash_price = $request->flash_price;
        $flashSale->update();
        Alert::toast('Updated', 'success');
        return redirect(route('flashSale.index'));
    }

    public function destroy(Request $request)
    {
        $flashSale = FlashSale::find($request->id);
        $flashSale->delete();
        Alert::toast('Deleted!', 'success');
        return redirect(route('flashSale.index'));
    }
}
