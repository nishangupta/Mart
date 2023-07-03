<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string img
 * @property string caption
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Carousel extends Model
{
    use HasFactory;

    protected $fillable = ['caption', 'img'];
}
