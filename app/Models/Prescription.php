<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\User;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'customerID',
        'orderID',
        'staffID',
        'approval',
        'prescription_upload'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customerID', 'id')->where('role', 'customer');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'orderID', 'id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staffID', 'id')->where('role', 'staff');
    }
}