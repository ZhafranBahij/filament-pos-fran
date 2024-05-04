<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDebt extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function company_debt_category()
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
