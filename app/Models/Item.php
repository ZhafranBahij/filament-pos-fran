<?php

namespace App\Models;

use App\Casts\PriceCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $casts = [
        'true_price' => PriceCast::class,
    ];

    public function item_category()
    {
        return $this->belongsTo(ItemCategory::class);
    }

    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }

    public function getTruePriceAttribute()
    {
        return 'Rp. '.$this->price + ($this->price * $this->tax()->first()->percentange / 100);
    }
}
