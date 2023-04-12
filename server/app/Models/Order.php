<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

    public function user() {
        return $this->belongsTo(User::class);
    }

//    public function getPdfPath(): Attribute
//    {
//        return Attribute::make(
//            get: fn () => url("storage/orders/order_pdf_{$this->id}.pdf", [], true)
//        );
//    }

//    public function getPdfPath(): Attribute
//    {
//        $url = url("storage/orders/order_pdf_{$this->id}.pdf");
//        $parsedUrl = parse_url($url);
//        $modifiedUrl = str_replace($parsedUrl['host'], $parsedUrl['host'] . ':85', $url);
//        return Attribute::make([
//            'pdf_url' => $modifiedUrl
//        ]);
//    }

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
    ];
}
