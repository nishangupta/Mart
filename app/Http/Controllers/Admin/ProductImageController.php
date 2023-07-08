<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductImageController extends Controller
{
    //product id
    public function index($id)
    {
        return ProductImage::where('product_id', $id)->get();
    }

    public function store(Request $request, $id)
    {
        if (!is_dir(public_path('/images/products'))) {
            mkdir(public_path('/images/products'), 0777);
        }

        $images = Collection::wrap($request->file('file'));

        $images->each(function ($image) use ($id) {
            $basename = Str::random();
            $original = $basename . '.' . $image->getClientOriginalExtension();
            $thumbnail = $basename . '_thumb.' . $image->getClientOriginalExtension();

            \Image::make($image)
                ->fit(250, 250)
                ->save(public_path('/images/products/' . $thumbnail));

            $image->move(public_path('/images/products'), $original);

            ProductImage::create([
                'product_id' => $id,
                'original' => '/images/products/' . $original,
                'thumbnail' => '/images/products/' . $thumbnail
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
