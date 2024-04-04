<?php

namespace App\Models; // Corrected the namespace

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\BlogImage;
class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['title', 'content'];

    public function image()
    {
        return $this->hasMany(BlogImage::class, 'blog_id');
    }
    

}
