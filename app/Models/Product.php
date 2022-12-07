<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'product_name',
        'product_image',
        'product_description',
        'price',
    ];
    protected $appends = [
        'name_price'
    ];

    public function getNamePriceAttribute() {
        return $this->product_name . ' ฿' . $this->price;
    }
}
