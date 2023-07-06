<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

/**
 * @property int id
 * @property int user_id
 * @property string subCategory
 * @property string title
 * @property string slug
 * @property string product_code
 * @property string price
 * @property string sale_price
 * @property bool onSale
 * @property bool live
 * @property string description
 * @property int stock
 * @property string brand
 * @property string warranty
 * @property string color
 * @property string size
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Collection productImage
 * @property ProductImage firstImage
 */
class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function productImage(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function firstImage(): HasMany
    {
        return $this->hasMany(ProductImage::class)->limit(1);
    }

    public function getImage(): HasMany
    {
        return $this->productImage();
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
        return $query->where('price', '<=', (int)$price);
    }

    public function path(): string
    {
        return URL::to("/shop/{$this->id}-" . Str::slug($this->title));
    }
}
