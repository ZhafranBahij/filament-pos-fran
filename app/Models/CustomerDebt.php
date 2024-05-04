<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDebt extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function customer_debt_category()
    {
        return $this->belongsTo(CustomerDebtCategory::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class);
    }

    public function updated_by()
    {
        return $this->belongsTo(User::class);
    }

    public function debtor()
    {
        return $this->belongsTo(User::class);
    }

    public function creditor()
    {
        return $this->belongsTo(User::class);
    }

}
