<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Material extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $dates = ['deleted_at'];
    protected $fillable =  ['name', 'stock', 'desc', 'price', 'category'];
    public function image()
    {
        return $this->hasMany(MaterialImage::class, 'material_id');
    }
    public function cart(){

        return $this->belongsToMany(Cart::class, 'cart_material', 'cart_id', 'material_id');
    }
    public function order(){

        return $this->belongsToMany(Cart::class, 'material_order', 'order_id', 'material_id');
    }
}
