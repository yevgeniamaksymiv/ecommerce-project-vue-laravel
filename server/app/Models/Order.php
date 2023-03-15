<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $guarded = false;

    public function products() {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id');
    }

    public function delivery() {
        return $this->belongsTo(Delivery::class);
    }
}
