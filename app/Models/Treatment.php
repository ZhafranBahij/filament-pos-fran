<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Treatment extends Model
{
    use HasFactory;

    protected $casts = [
        'price' => MoneyCast::class,
    ];


    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
