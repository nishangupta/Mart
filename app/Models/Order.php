<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int id
 * @property int user_id
 * @property int product_id
 * @property string order_number
 * @property int quantity
 * @property int shipping_cost
 * @property string payment
 * @property string price
 * @property string status
 * @property bool printed
 * @property Carbon deleted_at
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Product product
 * @property User user
 */
class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
