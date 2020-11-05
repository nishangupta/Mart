<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

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
        return $query->where('price', '>=', $price);
    }

    public function scopeMaxPrice(Builder $query, $price): Builder
    {
        return $query->where('price', '<=', $price);
    }

    public function path()
    {
        return url("/shop/{$this->id}-" . Str::slug($this->title));
    }
}
