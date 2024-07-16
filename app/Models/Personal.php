<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Personal extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'userID',
        'firstname',
        'lastname',
        'dob',
        'cpr',
    ];


   
public function user()
{
    return $this->belongsTo(User::class, 'userID', 'id');
}

public function addresses()
{
    return $this->hasMany(Address::class, 'personalID', 'id');
}

}

