<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockRequest extends Model
{
    use HasFactory;
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplierID', 'id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staffID', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'productID', 'id');
    }
}
