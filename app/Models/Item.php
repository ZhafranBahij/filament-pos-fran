<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function item_category()
    {
        return $this->belongsTo(ItemCategory::class);
    }

    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }
}
