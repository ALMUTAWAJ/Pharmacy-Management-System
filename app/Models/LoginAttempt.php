<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginAttempt extends Model
{
    use HasFactory;
    protected $fillable = [
        'userID', 'attempts', 'suspend_till'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'id');
    }
}


