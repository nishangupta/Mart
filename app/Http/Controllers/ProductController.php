<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{

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
        dd($request->all());
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
