<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ADMIN = 'ADMIN';
    const USER = 'USER';
    public function isAdmin() {
        return $this->role == self::ADMIN;
    }
    public function isUser() {
        return $this->role == self::USER;
    }
    public function carts() {
        return $this->hasMany(Cart::class, 'user_id', 'id');
    }
    public function ordersReject()
    {
        return $this->hasMany(Order::class)->where('status', 'reject');
    }
    public function ordersInprogress()
    {
        return $this->hasMany(Order::class)->where('status', 'in progress');
    }
    public function ordersApprove()
    {
        return $this->hasMany(Order::class)->where('status', 'approve');
    }
    public function ordersCancel()
    {
        return $this->hasMany(Order::class)->where('status', 'cancel');
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

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
}
