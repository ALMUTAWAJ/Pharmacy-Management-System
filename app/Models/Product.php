<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'price',
        'category',
        'description',
        'prescription_req',
        'supplierID',
        'stock',
        'exp_date',
    ];

    public function reviews()
{
    return $this->hasMany(Review::class,'productID', 'id');
}


public function orderDetails()
{
    return $this->hasMany(OrderDetail::class,'productID', 'id');
}

public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplierID', 'id');
    }


    public function stockRequests()
    {
        return $this->hasMany(StockRequest::class, 'staffID', 'id');
    }

    
}
