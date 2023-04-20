<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'orders';
    protected $guarded = false;

    public function products() {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')
            ->withPivot('count');
    }

    public function delivery() {
        return $this->belongsTo(Delivery::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getPdfPath(): Attribute
    {
        return Attribute::make(
            get: fn () => "storage/orders/order_pdf_{$this->id}.pdf"
        );
    }



    protected $fillable = [
        'delivery_address',
        'order_amount',
        'user_id',
        'delivery_id',
        'status',
    ];
}
