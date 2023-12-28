<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'phone',
        'email',
        'company_name',
        'commercial_register',
    ];


   

    public function products()
    {
        return $this->hasMany(Product::class, 'supplierID', 'id');
    }

    public function stockRequests()
    {
        return $this->hasMany(StockRequest::class, 'supplierID', 'id');
    }

    
}
