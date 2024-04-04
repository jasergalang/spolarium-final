<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\EventImage;
class Event extends Model
{
    Use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['title', 'date','time', 'description', 'location', 'category'];
    
    public function image()
    {
        return $this->hasMany(EventImage::class, 'event_id');
    }

}
