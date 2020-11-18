<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        return view('product.index');
    }

    public function create()
    {
        $categories = Category::get(['id', 'category_name']);
        $subCategories = SubCategory::get(['id', 'subCategory_name', 'category_id']);
        return view('product.create')->with(
            [
                'categories' => $categories,
                'subCategories' => $subCategories
            ]
        );
    }

    public function store(Request $request)
    {
        $this->requestValidate($request);

        $product = new Product();

        if ($this->productSave($product, $request)) {
            Alert::toast('Product added', 'success');
        } else {
            Alert::toast('Something went wrong', 'error');
        }
        return redirect(route('product.index'));
    }

    public function edit(Product $product)
    {
        $categories = Category::get(['id', 'category_name']);
        $subCategories = SubCategory::get(['id', 'subCategory_name', 'category_id']);
        return view('product.edit')->with([
            'product' => $product,
            'categories' => $categories,
            'subCategories' => $subCategories
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required|min:4',
            'price' => 'required',
            'stock' => 'required',
        ]);

        if ($request->subCategory === null) {
            Alert::toast('Must enter sub category', 'warning');
            return redirect()->back();
        }
        //id is product here
        if ($this->productUpdate($product, $request)) {
            Alert::toast('Product updated', 'success');
        } else {
            Alert::toast('Something went wrong', 'error');
        }
        return redirect(route('product.index'));
    }

    public function destroy(Product $product)
    {
        $product->delete();
        Alert::toast('Product Deleted Successfully!', 'success');
        return redirect()->route('product.index');
    }

    private function requestValidate($request)
    {
        return $request->validate([
            'title' => 'required|min:4',
            'subCategory' => 'required',
            'description' => 'sometimes',
            'price' => 'required',
            'stock' => 'required',
        ]);
    }

    private function productSave($product, $request)
    {
        $product->user_id = auth()->user()->id;
        $product->title = $request->title;
        $product->slug = Str::slug($request->title);
        $product->subCategory = $request->subCategory;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->stock = $request->stock;
        $product->product_code = Str::upper(Str::random(6));

        if ($request->warranty) {
            $product->warranty = $request->warranty;
        }
        if ($request->color) {
            $product->color = $request->color;
        }
        if ($request->size) {
            $product->size = $request->size;
        }
        if ($request->brand) {
            $product->brand = $request->brand;
        }
        $product->onSale = $request->onSale ? 1 : 0;
        $product->live = $request->live ? 1 : 0;

        if ($product->save()) {
            return true;
        }
        return false;
    }

    private function productUpdate($product, $request)
    {
        $product->title = $request->title;
        $product->slug = Str::slug($request->title);
        $product->subCategory = $request->subCategory;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->stock = $request->stock;

        if ($request->warranty) {
            $product->warranty = $request->warranty;
        }
        if ($request->color) {
            $product->color = $request->color;
        }
        if ($request->size) {
            $product->size = $request->size;
        }
        if ($request->brand) {
            $product->brand = $request->brand;
        }

        $product->onSale = $request->onSale ? 1 : 0;
        $product->live = $request->live ? 1 : 0;

        if ($product->save()) {
            return true;
        }
        return false;
    }
}
