<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(50);
        return view('admin.product.index',compact('products'));
    }

    public function create()
    {
        $categories = Category::allCategoryNames();
        return view('admin.product.create')->with(
            [
                'categories' => $categories,
            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:4',
            'description' => 'sometimes|min:3',
            'price' => 'required',
            'subCategory_id'=>'required',
            'status'=>'required'
        ]);

        DB::transaction(function()use($request){
            $product = Product::create([
                'title'=>$request->title,
                'description'=>$request->description,
                'slug'=>Str::slug($request->title),
                'product_code'=>Str::random(8),
                'price'=>$request->price,
                'discount'=>$request->discount,
                'brand'=>$request->brand??'',
                'warranty'=>$request->warranty?? null,
                'subCategory_id'=>$request->subCategory_id,
                'user_id'=>auth()->id(),
                'status'=>$request->status,
            ]);
            

            $attributes = json_decode($request->attr);
            // dd($attributes);

            foreach($attributes as $attr){
                $product->attributes()->create([
                    'uid'=>$attr->uid,
                    'type'=>$attr->type,
                    'attribute'=>$attr->attribute,
                    'stock'=>$attr->stock,
                    'live'=>$attr->live,
                ]);
            }

        });

        Alert::toast('Product created successfully!','success');
        return redirect(route('product.index'));
    }

    public function edit(Product $product)
    {
        $categories = Category::allCategoryNames();
        return view('admin.product.edit')->with([
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required|min:4',
            'description' => 'sometimes|min:3',
            'price' => 'required',
            'subCategory_id'=>'required',
            'status'=>'required'
        ]);

        
        $product->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'slug'=>Str::slug($request->title),
            'price'=>$request->price,
            'discount'=>$request->discount,
            'brand'=>$request->brand??null,
            'warranty'=>$request->warranty?? null,
            'subCategory_id'=>$request->subCategory_id,
            'user_id'=>auth()->id(),
            'status'=>$request->status,
            ]);
            
        //delete the relationships
        foreach($product->attributes as $item){
            $item->delete();
        }
            
        $attributes = json_decode($request->attr);

        foreach($attributes as $attr){
            $product->attributes()->create([
                'uid'=>$attr->uid,
                'type'=>$attr->type,
                'attribute'=>$attr->attribute,
                'stock'=>$attr->stock,
                'live'=>$attr->live,
            ]);
        }

        Alert::toast('Product updated', 'success');
        return redirect(route('product.index'));
    }

    public function destroy(Product $product)
    {
        $product->delete();
        Alert::toast('Product Deleted Successfully!', 'success');
        return redirect()->route('product.index');
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
