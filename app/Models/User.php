<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderReceipt;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    use SoftDeletes;

    protected $dates = ['deleted_at', 'updated_at', 'created_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['fname', 'lname', 'contact', 'email', 'password', 'roles', 'image_path','status'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function customer()
    {
        return $this->hasOne(Artist::class, 'user_id');
    }
    public function artist()
    {
        return $this->hasOne(Customer::class, 'user_id');
    }
    public function sendEmailOrderReceiptNotification($order)
    {
        Mail::to($this->email)->send(new OrderReceipt($order));
    }
}
