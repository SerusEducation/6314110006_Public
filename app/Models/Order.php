<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'user_id', 'order_no', 'address', 'tel', 'deliver_fee', 'status', 'slip'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    private function generateOrderNo() {
        $lastOrder = Order::where('created_at', date('Y'))->orderBy('order_no', 'DESC')->first();
        if ($lastOrder) {
            $last_no = intval(explode('-', $lastOrder->order_no)[1]) + 1;
            $orderNo = date('Ymd')."-".str_pad($last_no,5,0,STR_PAD_LEFT);
        } else {
            $orderNo = date('Ymd')."-".str_pad('1',5,0,STR_PAD_LEFT);
        }
        return $orderNo;
    }

    public static function boot() {
        parent::boot();
        static::creating(function($model) {
            $model->order_no = $model->generateOrderNo();
        });
    }
}
