<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Address;
use App\Models\OrderDetail;
use App\Models\Prescription;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customerID',
        'addressID',
        'total_price',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'customerID', 'id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'orderID', 'id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'addressID', 'id');
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class, 'orderID', 'id');
    }   
}