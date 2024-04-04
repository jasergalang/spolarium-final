<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = ['user_id'];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function cart()
    {
        return $this->hasOne(Cart::class, 'customer_id');
    }
    public function order()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }

}
