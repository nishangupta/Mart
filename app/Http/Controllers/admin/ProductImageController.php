<?php

namespace App\Http\Controllers\Admin;

use Image;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProductImageController extends Controller
{
    /** getting product images by id */
    public function index($id)
    {
        $products = ProductImage::where('product_id', $id)->get();
        return $products;
    }

    //storing images happens here
    public function store(Request $request, $id)
    {
        $images = Collection::wrap($request->file('file'));

        $images->each(function ($image) use ($id) {
            $basename = Str::random();
            $original = $basename . '.' . $image->getClientOriginalExtension();
            $thumbnail = $basename . '_thumb.' . $image->getClientOriginalExtension();

            Image::make($image)
                ->save(storage_path('/app/public/products/' . $thumbnail),20);

            $image->move(storage_path('/app/public/products'), $original);

            ProductImage::create([
                'product_id' => $id,
                'original' => '/storage/products/' . $original,
                'thumbnail' => '/storage/products/' . $thumbnail
            ]);
        });
    }

    //$id -- Product id
    public function show(Product $id)
    {
        return view('admin.product.show')->with([
            'product' => $id
        ]);
    }

    //$id is the Product Image id
    public function destroy(ProductImage $id)
    {
        File::delete([
            public_path($id->original),
            public_path($id->thumbnail),
        ]);
        $id->delete();
        return ['success' => true];
    }
}
