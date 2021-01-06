<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::allCategories();
        return view('admin.category.index')->with([
            'categories'=>$categories
        ]);
    }
    public function create()
    {
        return view('admin.category.create')->with([
            'parent_categories'=>Category::parentCategories(),
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|unique:categories',
            'status'=>'required',
        ]);

        if(is_null($request->is_parent)&& is_null($request->parent_id) ){
            return redirect()->back()->withErrors(['parent_id'=>'Must have a parent_id selected']);
        }

        $category = Category::create([
            'name'=>$request->name,
            'status'=>$request->status,
            'is_parent'=>$request->is_parent? 1:0,
            'parent_id'=>$request->parent_id ?? null,
            'slug'=>Str::slug($request->name),
        ]);

        Alert::toast('Category created', 'success');
        return redirect(route('category.index'));
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit')->with([
            'parent_categories' => Category::parentCategories(),
            'category'=>$category
        ]);
    }

    public function update(Request $request,Category $category)
    {
        $request->validate([
            'name' => 'required|min:3',
            'status' => 'required',
        ]);

        //parent_id must be available if the request data is not a parent 
        if(is_null($request->is_parent)&& is_null($request->parent_id) ){
            return redirect()->back()->withErrors(['parent_id'=>'Must have a parent_id selected']);
        }

        try {
            $category->update([
            'name'=>$request->name,
            'status'=>$request->status,
            'is_parent'=>$request->is_parent? 1:0,
            'parent_id'=>$request->parent_id ?? null,
            'slug'=>Str::slug($request->name),
        ]);
        }catch(\Exception $e){
            Alert::toast('Something went wrong');
            return redirect()->back();
        }
        Alert::toast('Category updated', 'success');
        return redirect(route('category.index'));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        Alert::toast('Category Deleted', 'success');
        return redirect(route('category.index'));
    }

}
