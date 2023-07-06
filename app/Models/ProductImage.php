<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property int product_id
 * @property string original
 * @property string thumbnail
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class ProductImage extends Model
{
    use HasFactory;

    protected $guarded = [];
}
