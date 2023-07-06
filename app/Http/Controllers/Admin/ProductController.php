<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View as ViewFactory;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function index(Product $productModel): View
    {
        return ViewFactory::make('admin.product.index', [
            'products' => $productModel->newQuery()->latest()->get(),
        ]);
    }

    public function create(Category $categoryModel, SubCategory $subCategoryModel): View
    {
        return ViewFactory::make('admin.product.create')->with(
            [
                'categories' => $categoryModel->newQuery()->get([
                    'id',
                    'category_name',
                ]),
                'subCategories' => $subCategoryModel->newQuery()->get([
                    'id',
                    'subCategory_name',
                    'category_id',
                ]),
            ],
        );
    }

    public function store(Request $request): RedirectResponse
    {
        $this->requestValidate($request);

        $product = new Product();

        if ($this->productSave($product, $request)) {
            Alert::toast('Product added', 'success');
        } else {
            Alert::toast('Something went wrong', 'error');
        }

        return Redirect::route('product.index');
    }

    public function edit(Product $product): View
    {
        $categories = Category::get(['id', 'category_name']);
        $subCategories = SubCategory::get(['id', 'subCategory_name', 'category_id']);

        return ViewFactory::make('admin.product.edit')->with([
            'product' => $product,
            'categories' => $categories,
            'subCategories' => $subCategories,
        ]);
    }

    public function update(Request $request, Product $product): RedirectResponse
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
        return Redirect::route('product.index');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        Alert::toast('Product Deleted Successfully!', 'success');
        return Redirect::route('product.index');
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

    private function productSave(Product $product, Request $request): bool
    {
        $product->user_id = Auth::user()->id;
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

        return $product->save();
    }

    private function productUpdate(Product $product, Request $request): bool
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

        return $product->save();
    }
}
