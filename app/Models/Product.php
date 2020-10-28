<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function path()
    {
        // return url("/real-estate/{$this->id}-" . Str::slug($this->name));
    }
}
