<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function activeCategories(){
        return Category::where('status',1)->get();
    }

    public static function inactiveCategories(){
        return Category::where('status',0)->get();
    }

    public static function parentCategories(){
        return Category::where('is_parent',1)->whereNull('parent_id')->get();
    }

    public static function subCategories(){
        return Category::whereNull('is_parent')->whereNotNull('parent_id')->get();
    }

    public static function subCategoriesByParent($parent_id){
        return Category::where('parent_id',$parent_id)->get();
    }

    public function parent_info(){
        return $this->hasOne('App\Models\Category','id','parent_id');
    }

    public static function allCategories(){
        return  Category::with('parent_info')->simplePaginate(50);
    }

    public static function allCategoryNames(){
        return Category::where('status',1)->with('parent_info')->get();
    }
}
