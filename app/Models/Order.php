<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id', 'payment_method', 'shipping_address', 'status'];
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'order_id');
    }
    public function review()
    {
        return $this->hasMany(Review::class, 'order_id');
    }
    public function artwork(){

        return $this->belongsToMany(Artwork::class, 'artwork_order', 'order_id', 'artwork_id');
    }
    public function material(){

        return $this->belongsToMany(Material::class, 'material_order', 'order_id', 'material_id');
    }
}
