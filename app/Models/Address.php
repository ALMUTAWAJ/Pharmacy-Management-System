<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;


    protected $fillable = [
        'personalID',
        'city',
        'house',
        'road',
        'block',
    ];
    
    public function personal()
    {
        return $this->belongsTo(Personal::class, 'personalID', 'id');
    } 
}

