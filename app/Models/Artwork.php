<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artwork extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $dates = ['deleted_at'];
    protected $fillable =  ['name', 'price', 'desc', 'size', 'category', 'artist_id'];

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'artist_id');
    }
    public function image()
    {
        return $this->hasMany(ArtImage::class, 'artwork_id');
    }
    public function cart(){

        return $this->belongsToMany(Cart::class, 'artwork_cart', 'cart_id', 'artwork_id');
    }
    public function order(){

        return $this->belongsToMany(Order::class, 'artwork_order', 'order_id', 'artwork_id');
    }
}
