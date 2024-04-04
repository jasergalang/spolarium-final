<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id'];
    public function customer(){

        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function artwork(){

        return $this->belongsToMany(Artwork::class, 'artwork_cart', 'cart_id', 'artwork_id');
    }
    public function material(){

        return $this->belongsToMany(Material::class, 'cart_material', 'cart_id', 'material_id');
    }

}
