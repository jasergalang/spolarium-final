<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtImage extends Model
{

    use HasFactory;
    protected $table ='art_images';
    protected $fillable = ['artwork_id', 'image_path'];
    public function artwork(){

        return $this->belongsTo(Artist::class, 'artwork_id');
    }
}
