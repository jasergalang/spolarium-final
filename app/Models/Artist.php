<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $table = 'artists';
    protected $fillable = ['user_id'];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function artwork()
    {
        return $this->hasMany(Artwork::class, 'artist_id');
    }
}
