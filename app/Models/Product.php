<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function productImage(): HasMany
    {
        return $this->hasMany('App\Models\ProductImage');
    }

    public function firstImage(): HasMany
    {
        return $this->hasMany(ProductImage::class)->limit(1);
    }

    public function getImage(): HasMany
    {
        return $this->productImage();
    }

    public function getQuestions(): HasMany
    {
        return $this->hasMany(CustomerQuestion::class);
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
