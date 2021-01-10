<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function attributes(){
        return $this->hasMany('App\Models\ProductAttribute');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category','subCategory_id','id');
    }
    
    // public function getAttribute($attr){
    //     return $this->attributes()->where('type',$attr);
    // }

    public function productImage()
    {
        return $this->hasMany('App\Models\ProductImage');
    }

    public function first_image()
    {
        return $this->hasMany('App\Models\ProductImage')->limit(1);
    }

    public function getImage()
    {
        return $this->productImage();
    }

    public function getQuestions()
    {
        return $this->hasMany('App\Models\CustomerQuestion');
    }

    public function scopeMightAlsoLike($query)
    {
        return $query->inRandomOrder()->with('first_image')->take(4);
    }

    public function scopeMinPrice(Builder $query, $price): Builder
    {
        return $query->where('price', '>=', (int)$price);
    }

    public function scopeMaxPrice(Builder $query, $price): Builder
    {
        return $query->where('price', '<=', (int) $price);
    }

    public function path()
    {
        return url("/shop/{$this->id}-" . Str::slug($this->title));
    }
}
