<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelCleanup\CleanupConfig;
use Spatie\ModelCleanup\GetsCleanedUp;

class Order extends Model implements GetsCleanedUp
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function cleanUp(CleanupConfig $config): void
    {
        //older than 6 months
        $config->olderThanDays(180);
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
