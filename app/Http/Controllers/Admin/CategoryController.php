<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }
    public function index()
    {
        $categories = Category::with('subCategory')->get();
        return view('admin.category.index', compact('categories'));
    }
    public function create()
    {
        return view('category.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|min:3',
            'sub_category' => 'required|min:3'
        ]);
        $category = new Category();
        $category->category_name = $request->category;
        $category->save();

        $subCategory = new SubCategory();
        $subCategory->category_id = $category->id;
        $subCategory->subCategory_name = $request->sub_category;
        $subCategory->save();
        Alert::toast('Category created', 'success');
        return redirect(route('category.index'));
    }

    public function edit(Category $id)
    {

        return view('admin.category.edit')->with([
            'category' => $id
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|min:3',
        ]);
        $category = Category::find($id);
        $category->category_name = $request->category;
        $category->save();

        if ($request->sub_category === null) {
            Alert::toast('Category updated', 'success');
        } else {
            $subCategory = new SubCategory();
            $subCategory->category_id = $category->id;
            $subCategory->subCategory_name = $request->sub_category;
            $subCategory->save();
            Alert::toast('Subcategory updated', 'success');
        }
        return redirect(route('category.index'));
    }

    public function destroy(Category $id)
    {
        //here id becomes category
        $id->delete();
        Alert::toast('Category Deleted', 'success');
        return redirect(route('category.index'));
    }

    public function removeSubCategory(SubCategory $subCategory)
    {
        $subCategory->delete();
        Alert::toast('SubCategory removed', 'success');
        return redirect(route('category.index'));
    }


    //sorting functions
    public function up($id)
    {
        $category = Category::find($id);

        if ($category->sort_index === 1) {
            return;
        }

        $nextCategory = Category::where('sort_index', $category->sort_index + 1)->get();
        if ($nextCategory) {
            $nextCategory->decrement('sort_index', 1);
        } else {
            return;
        }
    }
}
