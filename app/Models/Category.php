<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property SubCategory[] subCategory
 */
class Category extends Model
{
    use HasFactory;

    public function subCategory(): HasMany
    {
        return $this->hasMany(SubCategory::class);
    }
}
