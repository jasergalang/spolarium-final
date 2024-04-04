<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialImage extends Model
{
    use HasFactory;
    protected $fillable = ['material_id', 'image_path'];

    // Define relationship with Event model
    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }
}
